<?php

/**
 * Created by PhpStorm.
 * User: tuan
 * Date: 9/2/2015
 * Time: 7:12 PM
 */
class Paginator
{

    private $_conn;
    private $_limit;
    private $_page;
    private $_query;
    private $_total;

    public function __construct($conn, $query)
    {

        $this->_conn = $conn;
        $this->_query = $query;

        $rs = $this->_conn->query($this->_query);
        $this->_total = $rs->num_rows;

    }

    public function getData($page = 1, $limit = 10)
    {

        $this->_limit = $limit;
        $this->_page = $page;

        if ($this->_limit == 'all') {
            $query = $this->_query;
        } else {
            $query = $this->_query . " LIMIT " . (($this->_page - 1) * $this->_limit) . ", $this->_limit";
        }
        $rs = $this->_conn->query($query);

        $results = array();
        while ($row = $rs->fetch_assoc()) {
            $results[] = $row;
        }

        $result = new stdClass();
        $result->page = $this->_page;
        $result->limit = $this->_limit;
        $result->total = $this->_total;
        $result->data = $results;

        return $result;
    }

    public function createLinks($links, $list_class)
    {
        if ($this->_limit == 'all') {
            return '';
        }

        $last = ceil($this->_total / $this->_limit);
        $start = (($this->_page - $links) > 0) ? $this->_page - $links : 1;
        $end = (($this->_page + $links) < $last) ? $this->_page + $links : $last;

        $html = '<ul class="paginate paginate-light wrapper">';

        $class = ($this->_page == 1) ? "disabled" : "";

        $fullData = array_merge($_GET, array(
            'limit' => $this->_limit,
            'page' => $this->_page - 1
        ));

        if ($this->_page > 1) {
            $html .= '<li class="' . $class . '"><a href="?' . http_build_query($fullData) . '">&laquo;</a></li>';
        }

        if ($start > 1) {
            $fullData = array_merge($_GET, array(
                'limit' => $this->_limit,
                'page' => 1
            ));
            $html .= '<li><a href="?' . http_build_query($fullData) . '">1</a></li>';
            $html .= '<li><a href="" class="more">&hellip;</a></li>';
        }

        if ($last > 1) {
            for ($i = $start; $i <= $end; $i++) {
                $fullData = array_merge($_GET, array(
                    'limit' => $this->_limit,
                    'page' => $i
                ));
                $class = ($this->_page == $i) ? "active" : "";
                $html .= '<li><a class="' . $class . '" href="?' . http_build_query($fullData) . '">' . $i . '</a></li>';
            }
        }

        if ($end < $last) {
            $fullData = array_merge($_GET, array(
                'limit' => $this->_limit,
                'page' => $last
            ));
            $html .= '<li><a href="" class="more">&hellip;</a></li>';
            $html .= '<li><a href="?' . http_build_query($fullData) . '">' . $last . '</a></li>';
        }

        $class = ($this->_page == $last) ? "disabled" : "";
        $fullData = array_merge($_GET, array(
            'limit' => $this->_limit,
            'page' => $this->_page + 1
        ));

        if ($last > 1) {
            $html .= '<li class="' . $class . '"><a href="?' . http_build_query($fullData) . '">&raquo;</a></li>';
        }
        $html .= '</ul>';

        return $html;
    }
}