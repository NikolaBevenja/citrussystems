<?php


class CommentRemote extends CommentResource
{
    public function addAction($data){
        if($data['cmt_email'] && $data['cmt_name'] && $data['cmt_text'] && $data['pdt_id']){
            return $this->addComment($data);
        }else{
            return 0;
        }
    }

    public function acceptAction($data){
        if($data['cmt_id']){
            $cmt_id =  $this->setCommentStatus($data, 1);
            $comment = $this->getFullCommentById($cmt_id);
            $commentLayout = new CommentLayout();
            return $commentLayout->getAcceptedLayout($comment);
        }
    }

    public function declineAction($data){
        if($data['cmt_id']){
            $cmt_id = $this->setCommentStatus($data, 2);
            $comment = $this->getFullCommentById($cmt_id);
            $commentLayout = new CommentLayout();
            return $commentLayout->getDeclinedLayout($comment);
        }
    }
}