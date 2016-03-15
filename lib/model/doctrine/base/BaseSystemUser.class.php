<?php
// Connection Component Binding
Doctrine_Manager::getInstance()->bindComponent('Systemuser', 'doctrine');

/**
 * BaseSystemuser
 * 
 * This class has been auto-generated by the Doctrine ORM Framework
 * 
 * @property integer $system_user_id
 * @property string $login_name
 * @property string $login_password
 * @property string $display_name
 * @property integer $status
 * @property integer $department_id
 * @property integer $role_id
 * @property Department $Department
 * @property Roles $Roles
 * @property Doctrine_Collection $Orders
 * 
 * @method integer             getSystemUserId()   Returns the current record's "system_user_id" value
 * @method string              getLoginName()      Returns the current record's "login_name" value
 * @method string              getLoginPassword()  Returns the current record's "login_password" value
 * @method string              getDisplayName()    Returns the current record's "display_name" value
 * @method integer             getStatus()         Returns the current record's "status" value
 * @method integer             getDepartmentId()   Returns the current record's "department_id" value
 * @method integer             getRoleId()         Returns the current record's "role_id" value
 * @method Department          getDepartment()     Returns the current record's "Department" value
 * @method Roles               getRoles()          Returns the current record's "Roles" value
 * @method Doctrine_Collection getOrders()         Returns the current record's "Orders" collection
 * @method Systemuser          setSystemUserId()   Sets the current record's "system_user_id" value
 * @method Systemuser          setLoginName()      Sets the current record's "login_name" value
 * @method Systemuser          setLoginPassword()  Sets the current record's "login_password" value
 * @method Systemuser          setDisplayName()    Sets the current record's "display_name" value
 * @method Systemuser          setStatus()         Sets the current record's "status" value
 * @method Systemuser          setDepartmentId()   Sets the current record's "department_id" value
 * @method Systemuser          setRoleId()         Sets the current record's "role_id" value
 * @method Systemuser          setDepartment()     Sets the current record's "Department" value
 * @method Systemuser          setRoles()          Sets the current record's "Roles" value
 * @method Systemuser          setOrders()         Sets the current record's "Orders" collection
 * 
 * @package    space
 * @subpackage model
 * @author     Javkhlan Gansukh
 * @version    SVN: $Id: Builder.php 7490 2010-03-29 19:53:27Z jwage $
 */
abstract class BaseSystemuser extends sfDoctrineRecord
{
    public function setTableDefinition()
    {
        $this->setTableName('systemuser');
        $this->hasColumn('system_user_id', 'integer', 8, array(
             'type' => 'integer',
             'fixed' => 0,
             'unsigned' => false,
             'primary' => true,
             'autoincrement' => true,
             'length' => 8,
             ));
        $this->hasColumn('login_name', 'string', 40, array(
             'type' => 'string',
             'fixed' => 0,
             'unsigned' => false,
             'primary' => false,
             'notnull' => false,
             'autoincrement' => false,
             'length' => 40,
             ));
        $this->hasColumn('login_password', 'string', 32, array(
             'type' => 'string',
             'fixed' => 0,
             'unsigned' => false,
             'primary' => false,
             'notnull' => false,
             'autoincrement' => false,
             'length' => 32,
             ));
        $this->hasColumn('display_name', 'string', 50, array(
             'type' => 'string',
             'fixed' => 0,
             'unsigned' => false,
             'primary' => false,
             'notnull' => false,
             'autoincrement' => false,
             'length' => 50,
             ));
        $this->hasColumn('status', 'integer', 1, array(
             'type' => 'integer',
             'fixed' => 0,
             'unsigned' => false,
             'primary' => false,
             'default' => '1',
             'notnull' => true,
             'autoincrement' => false,
             'length' => 1,
             ));
        $this->hasColumn('department_id', 'integer', 8, array(
             'type' => 'integer',
             'fixed' => 0,
             'unsigned' => false,
             'primary' => false,
             'notnull' => true,
             'autoincrement' => false,
             'length' => 8,
             ));
        $this->hasColumn('role_id', 'integer', 8, array(
             'type' => 'integer',
             'fixed' => 0,
             'unsigned' => false,
             'primary' => false,
             'notnull' => true,
             'autoincrement' => false,
             'length' => 8,
             ));
    }

    public function setUp()
    {
        parent::setUp();
        $this->hasOne('Department', array(
             'local' => 'department_id',
             'foreign' => 'department_id'));

        $this->hasOne('Roles', array(
             'local' => 'role_id',
             'foreign' => 'role_id'));

        $this->hasMany('Orders', array(
             'local' => 'system_user_id',
             'foreign' => 'system_user_id'));
    }
}