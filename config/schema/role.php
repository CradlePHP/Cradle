<?php //-->
return array (
  'singular' => 'Role',
  'plural' => 'Roles',
  'name' => 'role',
  'group' => 'Users',
  'icon' => 'fas fa-key',
  'detail' => 'By default, all users are locked out from accessing anything in the system. Roles gives users permission to access certain parts of the system based on URL rules.',
  'fields' => 
  array (
    0 => 
    array (
      'label' => 'Name',
      'name' => 'name',
      'field' => 
      array (
        'type' => 'text',
        'attributes' => 
        array (
          'placeholder' => 'ex. Guest',
        ),
      ),
      'validation' => 
      array (
        0 => 
        array (
          'method' => 'required',
          'message' => 'Name is required',
        ),
      ),
      'list' => 
      array (
        'format' => 'none',
      ),
      'detail' => 
      array (
        'format' => 'none',
      ),
      'default' => '',
      'searchable' => '1',
      'disable' => '1',
    ),
    1 => 
    array (
      'label' => 'Slug',
      'name' => 'slug',
      'field' => 
      array (
        'type' => 'slug',
        'attributes' => 
        array (
          'data-source' => 'input[name="role_name"]',
          'data-space' => '_',
          'data-lower' => '1',
        ),
      ),
      'validation' => 
      array (
        0 => 
        array (
          'method' => 'required',
          'message' => 'Slug is required',
        ),
        1 => 
        array (
          'method' => 'unique',
          'message' => 'Should be unique',
        ),
      ),
      'list' => 
      array (
        'format' => 'none',
      ),
      'detail' => 
      array (
        'format' => 'none',
      ),
      'default' => '',
      'searchable' => '1',
      'disable' => '1',
    ),
    2 => 
    array (
      'label' => 'Locked',
      'name' => 'locked',
      'field' => 
      array (
        'type' => 'switch',
      ),
      'validation' => 
      array (
        0 => 
        array (
          'method' => 'lte',
          'parameters' => '1',
          'message' => 'Should be either 0 or 1',
        ),
        1 => 
        array (
          'method' => 'gte',
          'parameters' => '0',
          'message' => 'Should be either 0 or 1',
        ),
      ),
      'list' => 
      array (
        'format' => 'yes',
      ),
      'detail' => 
      array (
        'format' => 'yes',
      ),
      'default' => '0',
      'filterable' => '1',
      'sortable' => '1',
      'disable' => '1',
    ),
    3 => 
    array (
      'label' => 'Permissions',
      'name' => 'permissions',
      'field' => 
      array (
        'type' => 'rawjson',
      ),
      'list' => 
      array (
        'format' => 'hide',
      ),
      'detail' => 
      array (
        'format' => 'hide',
      ),
      'default' => '',
      'disable' => '1',
    ),
    4 => 
    array (
      'label' => 'Admin Menu',
      'name' => 'admin_menu',
      'field' => 
      array (
        'type' => 'rawjson',
      ),
      'list' => 
      array (
        'format' => 'hide',
      ),
      'detail' => 
      array (
        'format' => 'hide',
      ),
      'default' => '',
      'disable' => '1',
    ),
    5 => 
    array (
      'label' => 'Active',
      'name' => 'active',
      'field' => 
      array (
        'type' => 'active',
      ),
      'list' => 
      array (
        'format' => 'hide',
      ),
      'detail' => 
      array (
        'format' => 'hide',
      ),
      'default' => '1',
      'filterable' => '1',
      'sortable' => '1',
      'disable' => '1',
    ),
    6 => 
    array (
      'label' => 'Created',
      'name' => 'created',
      'field' => 
      array (
        'type' => 'created',
      ),
      'list' => 
      array (
        'format' => 'none',
      ),
      'detail' => 
      array (
        'format' => 'none',
      ),
      'default' => 'NOW()',
      'sortable' => '1',
      'disable' => '1',
    ),
    7 => 
    array (
      'label' => 'Updated',
      'name' => 'updated',
      'field' => 
      array (
        'type' => 'updated',
      ),
      'list' => 
      array (
        'format' => 'none',
      ),
      'detail' => 
      array (
        'format' => 'none',
      ),
      'default' => 'NOW()',
      'sortable' => '1',
      'disable' => '1',
    ),
  ),
  'suggestion' => '{{role_name}}',
  'disable' => '1',
);