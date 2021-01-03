<?php

use Aws\S3\S3Client;
use Aws\Exception\AwsException;
use Aws\S3\Exception\S3Exception;

/**
 * Description of AWSS3Manager
 *
 * @author Alaa
 */
class AWSS3Manager {

    const S3Bucket = "aumetapps";
    const arrImagesExt = ["png", "jpg", "jpeg", "gif", "svg"];
    const cdnBase = "https://dhv4rhmdehex9.cloudfront.net";
    const imagesDIR = "images/";
    const imagesTeleportersSubDIR = "app/teleporters";
    const imagesDCBHomePageLogoSubDIR = "app/dcb/homepage/logo";
    const imagesDCBHomePageBackGroundSubDIR = "app/dcb/homepage/bg";

    private $s3;
    public $error;

    public function __construct() {
        $this->s3 = new Aws\S3\S3Client([
            'version' => 'latest',
            'region' => 'us-west-1',
            'credentials' => [
                'key' => getenv('AWS_ACCESS_KEY'),
                'secret' => getenv('AWS_SECRET_ACCESS_KEY')
            ]
        ]);
    }

    public function upload($strKey, $strFilePath) {

        try {
            $upObject = $this->s3->putObject([
                'Bucket' => S3Manager::S3Bucket,
                'Key' => $strKey,
                'SourceFile' => $strFilePath
            ]);

            $result = $this->s3->getObject([
                'Bucket' => S3Manager::S3Bucket,
                'Key' => $strKey
            ]);

            return $result['@metadata']["effectiveUri"];
        } catch (S3Exception $e) {

            $this->error = $e;
            //return $e->getMessage();

            return false;
        } catch (AwsException $e) {
            $this->error = $e;
            // This catches the more generic AwsException. You can grab information
            // from the exception using methods of the exception object.
            //echo $e->getAwsRequestId() . "\n";
            //echo $e->getAwsErrorType() . "\n";
            //echo $e->getAwsErrorCode() . "\n";
            // This dumps any modeled response data, if supported by the service
            // Specific members can be accessed directly (e.g. $e['MemberName'])
            //var_dump($e->toArray());

            return false;
        }
    }

    public function getImages($subFolder) {

        $arrObjects = [];
        $varNextContinuationToken = '';
        while (true) {
            $s3Objects = $this->s3->listObjectsV2([
                'Bucket' => S3Manager::S3Bucket,
                "Prefix" => S3Manager::imagesDIR . "$subFolder/",
                "continuation-token" => "$varNextContinuationToken"
            ]);

            if ($s3Objects["KeyCount"] > 0) {
                foreach ($s3Objects['Contents'] as $object) {
                    $extension = pathinfo($object['Key'], PATHINFO_EXTENSION);
                    if (in_array(strtolower($extension), S3Manager::arrImagesExt)) {
                        array_push($arrObjects, S3Manager::cdnBase."/" . $object['Key']);
                    }
                }

                if (!$s3Objects["IsTruncated"]) {
                    break;
                } else {
                    $varNextContinuationToken = $s3Objects["NextContinuationToken"];
                }
            } else {
                break;
            }
        }

        return $arrObjects;
    }

    public function getTeleporterImages() {
        return $this->getImages(S3Manager::imagesTeleportersSubDIR);
    }

    public function uploadTeleporterImage($strFileName, $strFilePath) {
        $strBaseFileName = basename($strFileName);
        return $this->upload(S3Manager::imagesDIR . S3Manager::imagesTeleportersSubDIR . "/" . $strBaseFileName, $strFilePath);
    }

    public function uploadDCBOperatorHomePageLogo($strFileName, $strFilePath) {
        $strBaseFileName = basename($strFileName);
        $url = $this->upload(S3Manager::imagesDIR . S3Manager::imagesDCBHomePageLogoSubDIR . "/" . $strBaseFileName, $strFilePath);

        if ($url) {
            return S3Manager::cdnBase . parse_url($url, PHP_URL_PATH);
        }
        else {
            return FALSE;
        }
    }
    
    public function uploadDCBOperatorHomePageBG($strFileName, $strFilePath) {
        $strBaseFileName = basename($strFileName);
        $url = $this->upload(S3Manager::imagesDIR . S3Manager::imagesDCBHomePageBackGroundSubDIR . "/" . $strBaseFileName, $strFilePath);

        if ($url) {
            return S3Manager::cdnBase . parse_url($url, PHP_URL_PATH);
        }
        else {
            return FALSE;
        }
    }

}
