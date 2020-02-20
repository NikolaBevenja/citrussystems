<?php


class CommentLayout
{
    public function getLayout($comment){
       $html = '';
       $html.= '<p>customer:'. $comment['cmt_name'] .'</p>';
       $html.= '<p>'.$comment['cmt_text'].'</p><hr>';
       return $html;
    }

    public function getAcceptedLayout($comment){
        $html = '';
        $html .= '<div id="'.$comment['cmt_id'].'" style="background: #59BD29; padding: 10px; margin: 10px 0;">';
            $html .= '<p>'. $comment['pdt_name'] .'</p>';
            $html .= '<p>'. $comment['cmt_email'].' : '.$comment['cmt_name'].'</p>';
            $html .= '<p>Comment: '.$comment['cmt_text'] .'</p>';
        $html .= '</div>';
        return $html;
    }

    public function getDeclinedLayout($comment){
        $html = '';
        $html .= '<div id="'.$comment['cmt_id'].'" style="background: #E72309; padding: 10px; margin: 10px 0;">';
        $html .= '<p>'. $comment['pdt_name'] .'</p>';
        $html .= '<p>'. $comment['cmt_email'].' : '.$comment['cmt_name'].'</p>';
        $html .= '<p>Comment: '.$comment['cmt_text'] .'</p>';
        $html .= '</div>';
        return $html;
    }
}