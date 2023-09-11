<?php  
namespace App;

class pageLink{
    public function generate($data, $page){
        $totalPage = $data->lastPage();
        $disabledPrev = $data->previousPageUrl() == "" ? 'disabled' : "";
        $disabledNext = $data->nextPageUrl() == "" ? 'disabled' : "";

        $result = '<nav aria-label="Page navigation example">
                            <ul class="pagination justify-content-end">
                                <li class="page-item ' . $disabledPrev . '">
                                    <a class="page-link" href="' . $data->previousPageUrl() . '" aria-label="Previous">
                                    <span aria-hidden="true">&laquo;</span>
                                    </a>
                                </li>';

        if($totalPage <= 6){
            for($index = 1; $index <= $totalPage; $index++){
                $isPageActive = $index == $page ? 'active' : '';
                $result .= '<li class="page-item ' . $isPageActive . '">
                                        <a class="page-link" href="' . $data->url($index) . '">' . $index . '</a>
                                    </li>';
            }
            // 1 2 3 4 5 6
        }else{
            if($page < 5){
                for($index = 1; $index <= 5; $index++){
                    $isPageActive = $index == $page ? 'active' : '';
                    $result .= '<li class="page-item ' . $isPageActive . '">
                                        <a class="page-link" href="' . $data->url($index) . '">' . $index . '</a>
                                    </li>';
                }

                $result .= '<li class="page-item disabled">
                                        <a class="page-link">...</a>
                                    </li>
                                    <li class="page-item">
                                        <a class="page-link" href="' . $data->url($totalPage) . '">' . $totalPage . '</a>
                                    </li>';
                // 1 2 3 4 5 ... 20
            }elseif($page == $totalPage || $totalPage-$page < 4){
                $result .= '<li class="page-item">
                                        <a class="page-link" href="' . $data->url(1) . '">1</a>
                                    </li>
                                    <li class="page-item disabled">
                                        <a class="page-link">...</a>
                                    </li>';

                for($index = $totalPage-4; $index <= $totalPage; $index++){
                    $isPageActive = $index == $page ? 'active' : '';
                    $result .= '<li class="page-item ' . $isPageActive . '">
                                            <a class="page-link" href="' . $data->url($index) . '">' . $index . '</a>
                                        </li>';
                }
                // 1 ... 16 17 18 19 20
            }else{
                $result .= '<li class="page-item">
                                        <a class="page-link" href="' . $data->url(1) . '">1</a>
                                    </li>
                                    <li class="page-item disabled">
                                        <a class="page-link">...</a>
                                    </li>';
                for($index = $page-1; $index<=$page+1; $index++){
                    $isPageActive = $index == $page ? 'active' : '';
                    $result .= '<li class="page-item ' . $isPageActive . '">
                                            <a class="page-link" href="' . $data->url($index) . '">' . $index . '</a>
                                        </li>';
                }
                $result .= '<li class="page-item disabled">
                                        <a class="page-link">...</a>
                                    </li>
                                    <li class="page-item">
                                        <a class="page-link" href="' . $data->url($totalPage) . '">' . $totalPage . '</a>
                                    </li>';
                // 1 ... 15 16 17 ... 20
            }
        }

        $result .= '     <li class="page-item ' . $disabledNext . '">
                                    <a class="page-link" href="' . $data->nextPageUrl() . '" aria-label="Next">
                                    <span aria-hidden="true">&raquo;</span>
                                    </a>
                                </li>
                            </ul>
                        </nav>';

        return $result;
    }
}