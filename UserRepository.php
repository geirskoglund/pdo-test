<?php
class UserRepository extends BaseRepository implements IUserRepository
{
    protected function entityName(){
        return "User";
    }
    protected function baseSelect(){
        return "select username, password, full_name, email 
                from board_users";
    }
    
    public function getByMemberId($memberId)
    {
        $sql = $this->getSql("where member_id = ?");
        $helper = $this->createPdoHelper($sql);
        $helper->addParams($memberId);
        return $helper->getSingleEntity($this->entityName);
    }
    
    public function getById($userId)
    {
        $sql = $this->getSql("where user_id = ?");
        $helper = $this->createPdoHelper($sql);
        $helper->addParams($userId);
        return $helper->getSingleEntity($this->entityName);
    }
    
    public function getAll(FilterArray $filter = null)
    {
        $where = "";
        $params = [];
        if($filter != null){
            //TODO: add to where and params
        }
        $sql = $this->getSql($where);
        $helper = $this->createPdoHelper($sql);
        $helper->addParams($params);
        return $helper->getEntities($this->entityName);
    }
}