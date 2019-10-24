<?php
namespace Admin\Common;
use Think\Page;

class MyPage extends Page
{

  // 分页显示定制
  protected $config = array(
    'header' => '<li class="paginate_button previous" aria-controls="dynamic-table" tabindex="0" id="dynamic-table_previous"><span class="rows">共 %TOTAL_ROW% 条记录</span></li>',
    'prev' => '上一页',
    'next' => '下一页',
    'first' => '第一页',
    'last'  => '最后一页',
    'theme' => '%FIRST% %UP_PAGE% %LINK_PAGE% %DOWN_PAGE% %END% %HEADER% %NOW_PAGE%',
  );
  /**
   * 组装分页链接
   * @return string
   */
  public function show()
  {
    if (0 == $this->totalRows) return '';

    /* 生成URL */
    $this->parameter[$this->p] = '[PAGE]';
    $this->url = U(ACTION_NAME, $this->parameter);
    /* 计算分页信息 */
    $this->totalPages = ceil($this->totalRows / $this->listRows); //总页数
    if (!empty($this->totalPages) && $this->nowPage > $this->totalPages) {
      $this->nowPage = $this->totalPages;
    }

    /* 计算分页临时变量 */
    $now_cool_page = $this->rollPage / 2;
    $now_cool_page_ceil = ceil($now_cool_page);
    $this->lastSuffix && $this->config['last'] = $this->totalPages;

    //上一页
    $up_row = $this->nowPage - 1;
    $up_page = $up_row > 0 ? '<li class="paginate_button previous" aria-controls="dynamic-table" tabindex="0" id="dynamic-table_previous"><a class="prev" href="' . $this->url($up_row) . '">' . $this->config['prev'] . '</a></li>' : '';

    //下一页
    $down_row = $this->nowPage + 1;
    $down_page = ($down_row <= $this->totalPages) ? '<li class="paginate_button next" aria-controls="dynamic-table" tabindex="0" id="dynamic-table_next"><a class="next" href="' . $this->url($down_row) . '">' . $this->config['next'] . '</a></li>' : '';

    //第一页
    $the_first = '';
    if ($this->totalPages > 1 && $this->nowPage !== 1) {
      $the_first = '<li class="paginate_button previous" aria-controls="dynamic-table" tabindex="0" id="dynamic-table_previous"><a class="first" href="' . $this->url(1) . '">' . $this->config['first'] . '</a></li>';
    }

    //最后一页
    $the_end = '';
    if ($this->totalPages > 1 && $this->nowPage != $this->totalPages) {
      $the_end = '<li class="paginate_button " aria-controls="dynamic-table" tabindex="0"><a href="' . $this->url($this->totalPages) . '">最后一页</a></li>';
    }
    //数字连接
    $link_page = "";
    for ($i = 1; $i <= $this->rollPage; $i++) {
      if (($this->nowPage - $now_cool_page) <= 0) {
        $page = $i;
      } elseif (($this->nowPage + $now_cool_page - 1) >= $this->totalPages) {
        $page = $this->totalPages - $this->rollPage + $i;
      } else {
        $page = $this->nowPage - $now_cool_page_ceil + $i;
      }
      if ($page > 0 && $page != $this->nowPage) {

        if ($page <= $this->totalPages) {
          $link_page .= '<li class="paginate_button " aria-controls="dynamic-table" tabindex="0"><a class="num" href="' . $this->url($page) . '">' . $page . '</a></li>';
        } else {
          break;
        }
      } else {
        if ($page > 0 && $this->totalPages != 1) {
          $link_page .= '<li class="paginate_button active" aria-controls="dynamic-table" tabindex="0"><span class="current">' . $page . '</span></li>';
        }
      }
    }
    //替换分页内容
    $page_str = str_replace(
      array('%HEADER%', '%NOW_PAGE%', '%UP_PAGE%', '%DOWN_PAGE%', '%FIRST%', '%LINK_PAGE%', '%END%', '%TOTAL_ROW%', '%TOTAL_PAGE%'),
      array($this->config['header'], "<li class='paginate_button' aria-controls='dynamic-table' tabindex='0'><span >当前页是第{$this->nowPage}页</span></li>", $up_page, $down_page, $the_first, $link_page, $the_end, $this->totalRows),
      $this->config['theme']);
    return "<ul class='pagination'>{$page_str}</ul>";
  }
}
