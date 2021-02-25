<?php

class Message extends \BaseModel
{
    public function __construct()
    {
        global $dbConnectionAumet;

        parent::__construct($dbConnectionAumet, 'onex.message');
    }


    public function getByToMessage($userId,$status)
    {
        $arr = parent::getWhere('"toUserId"='.$userId.' and "status"='.$status);
        if(count($arr) > 0){
            return $arr[0];
        }
        else {
            return false;
        }
    }
    public function getByFromMessage($userId,$status)
    {
        $arr = parent::getWhere('"fromUserId"='.$userId.' and "status"='.$status);
        if(count($arr) > 0)
        {
            return $arr[0];
        }
        else {
            return false;
        }
    }


    public function getByFromCompany($companyId)
    {
        return $this->getByField('"fromCompanyId"', $companyId);
    }

    public function getByToCompany($companyId)
    {
        return $this->getByField('"toCompanyId"', $companyId);
    }

    public function getById($messageId)
    {
        return $this->getByField('"id"', $messageId);
    }

    public function getByFromUserId($userId)
    {
        return parent::getByField('"fromUserId"', $userId);
    }
    public function getByToUserId($userId)
    {
        return parent::getWhere('"toUserId"='.$userId);
    }

    function getDatatableNonObject($data, $sortBy, $sortType = 'asc'){
        $datatable = array_merge(['pagination' => [], 'sort' => [], 'query' => []], $_REQUEST);
        $allData = $data;
        // search filter by keywords
        $filter = isset($datatable['query']['generalSearch']) && is_string($datatable['query']['generalSearch'])
            ? $datatable['query']['generalSearch'] : '';
        if (!empty($filter)) {
            $data = array_filter($data, function ($a) use ($filter) {
                return (bool)preg_grep("/$filter/i", (array)$a);
            });
            unset($datatable['query']['generalSearch']);
        }

        // filter by field query
        $query = isset($datatable['query']) && is_array($datatable['query']) ? $datatable['query'] : null;
        if (is_array($query)) {
            $query = array_filter($query);
            foreach ($query as $key => $val) {
                $data = list_filter($data, [$key => $val]);
            }
        }

        $sort  = !empty($datatable['sort']['sort']) ? $datatable['sort']['sort'] : $sortType;
        $field = !empty($datatable['sort']['field']) ? $datatable['sort']['field'] : $sortBy;

        $page    = !empty($datatable['pagination']['page'])     ? (int)$datatable['pagination']['page']     : 1;
        $perpage = !empty($datatable['pagination']['perpage'])  ? (int)$datatable['pagination']['perpage']  : -1;

        $pages = 1;
        $total = count($data); // total items in array

        // sort ...

        // $perpage 0; get all data
        if ($perpage > 0) {
            $pages  = ceil($total / $perpage); // calculate total pages
            $page   = max($page, 1); // get 1 page when $_REQUEST['page'] <= 0
            $page   = min($page, $pages); // get last page when $_REQUEST['page'] > $totalPages
            $offset = ($page - 1) * $perpage;
            if ($offset < 0) {
                $offset = 0;
            }
            $data = array_slice($data, $offset, $perpage, true);
        }

        $meta = [
            'page'    => $page,
            'pages'   => $pages,
            'perpage' => $perpage,
            'total'   => $total,
        ];


        // if selected all records enabled, provide all the ids
        if (isset($datatable['requestIds']) && filter_var($datatable['requestIds'], FILTER_VALIDATE_BOOLEAN)) {
            $meta['rowIds'] = array_map(function ($row) {
                foreach ($row as $first) break;
                return $first;
            }, $allData);
        }


        return [
            'meta' => $meta + [
                    'sort'  => $sort,
                    'field' => $field,
                ],
            'data' => $data,
        ];
    }
}