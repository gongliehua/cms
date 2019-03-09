<?php

// 分页类
class Page {
    private $total;         // 总条数
    private $pageSize;      // 每页条数
    private $limit;         // 分页开始条数
    private $page;          // 页码
    private $pageNum;       // 总页码
    private $url;           // URL
    private $bothNum;       // 两边保持分页的量

    // 初始化
    public function __construct($_total,$_pageSize)
    {
        $this->total = $_total;
        $this->pageSize = $_pageSize;
        $this->pageNum = ceil($this->total / $this->pageSize);
        $this->page = $this->setPage();
        $this->limit = "LIMIT ".($this->page - 1) * $this->pageSize.",$_pageSize";
        $this->url = $this->setUrl();
        $this->bothNum = 2;
    }

    // 拦截器
    public function __get($_key)
    {
        return $this->$_key;
    }

    // 获取当前页码
    public function setPage()
    {
        if (isset($_GET['page'])) {
            if ($_GET['page'] > 0) {
                if ($_GET['page'] > $this->pageNum) {
                    return $this->pageNum;
                } else {
                    return $_GET['page'];
                }
            } else {
                return 1;
            }
        } else {
            return 1;
        }
    }

    // 获取地址
    private function setUrl()
    {
        $_url = $_SERVER['REQUEST_URI'];
        $_par = parse_url($_url);
        if (isset($_par['query'])) {
            parse_str($_par['query'],$_query);
            unset($_query['page']);
            $_url = $_par['path']."?".http_build_query($_query);
        }
        return $_url;
    }

    // 数字分页
    private function pageList()
    {
        $_pageList = '';
        for ($i = $this->bothNum; $i >= 1; $i--) {
            $_page = $this->page - $i;
            if ($_page < 1) continue;
            $_pageList .= '<a href="'.$this->url.'&page='.$_page.'">'.$_page.'</a>';
        }
        $_pageList .= '<span class="me">'.$this->page.'</span>';
        for ($i = 1; $i <= $this->bothNum; $i++) {
            $_page = $this->page + $i;
            if ($_page > $this->pageNum) break;
            $_pageList .= '<a href="'.$this->url.'&page='.$_page.'">'.$_page.'</a>';
        }
        return $_pageList;
    }

    // 首页
    private function first()
    {
        if ($this->page > $this->bothNum+1) {
            return '<a href="'.$this->url.'">1</a>...';
        }
    }

    // 上一页
    private function prev()
    {
        if ($this->page == 1) {
            return '<span class="disabled">上一页</span>';
        }
        return ' <a href="'.$this->url.'&page='.($this->page - 1).'">上一页</a>';
    }

    // 下一页
    private function next()
    {
        if ($this->page == $this->pageNum) {
            return '<span class="disabled">下一页</span>';
        }
        return ' <a href="'.$this->url.'&page='.($this->page + 1).'">下一页</a>';
    }

    // 尾页
    private function last()
    {
        if (($this->pageNum - $this->page) > $this->bothNum) {
            return '...<a href="' . $this->url . '&page=' . $this->pageNum . '">' . $this->pageNum . '</a>';
        }
    }

    // 分页信息
    public function showPage()
    {
        $_page = $this->first();
        $_page .= $this->pageList();
        $_page .= $this->last();
        $_page .= $this->prev();
        $_page .= $this->next();
        return $_page;
    }
}
