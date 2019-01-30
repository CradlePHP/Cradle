<?php //-->
return array (
  'singular' => 'History',
  'plural' => 'History',
  'name' => 'history',
  'group' => 'Users',
  'icon' => 'fas fa-history',
  'detail' => 'Generic history designed to log all activities on the system.',
  'fields' => 
  array (
    0 => 
    array (
      'label' => 'Activity',
      'name' => 'activity',
      'field' => 
      array (
        'type' => 'textarea',
      ),
      'validation' => 
      array (
        0 => 
        array (
          'method' => 'required',
          'message' => 'Activity is Required',
        ),
        1 => 
        array (
          'method' => 'empty',
          'message' => 'Cannot be empty',
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
      'label' => 'Page',
      'name' => 'page',
      'field' => 
      array (
        'type' => 'textarea',
      ),
      'validation' => 
      array (
        0 => 
        array (
          'method' => 'required',
          'message' => 'Page is Required',
        ),
        1 => 
        array (
          'method' => 'empty',
          'message' => 'Cannot be empty',
        ),
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
      'searchable' => '1',
      'disable' => '1',
    ),
    2 => 
    array (
      'label' => 'Path',
      'name' => 'path',
      'field' => 
      array (
        'type' => 'text',
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
    3 => 
    array (
      'label' => 'Type',
      'name' => 'type',
      'field' => 
      array (
        'type' => 'text',
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
      'label' => 'Table Name',
      'name' => 'table_name',
      'field' => 
      array (
        'type' => 'text',
      ),
      'list' => 
      array (
        'format' => 'hide',
      ),
      'detail' => 
      array (
        'format' => 'lower',
      ),
      'default' => '',
      'filterable' => '1',
      'disable' => '1',
    ),
    5 => 
    array (
      'label' => 'Table ID',
      'name' => 'table_id',
      'field' => 
      array (
        'type' => 'text',
      ),
      'list' => 
      array (
        'format' => 'hide',
      ),
      'detail' => 
      array (
        'format' => 'none',
      ),
      'default' => '',
      'filterable' => '1',
      'disable' => '1',
    ),
    6 => 
    array (
      'label' => 'Flag',
      'name' => 'flag',
      'field' => 
      array (
        'type' => 'small',
      ),
      'validation' => 
      array (
        0 => 
        array (
          'method' => 'one',
          'parameters' => 
          array (
            0 => '1',
            1 => '0',
          ),
          'message' => 'Flag should be specified.',
        ),
      ),
      'list' => 
      array (
        'format' => 'hide',
      ),
      'detail' => 
      array (
        'format' => 'hide',
      ),
      'default' => '0',
      'disable' => '1',
    ),
    7 => 
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
      'sortable' => '1',
      'disable' => '1',
    ),
    8 => 
    array (
      'label' => 'Created',
      'name' => 'created',
      'field' => 
      array (
        'type' => 'created',
      ),
      'list' => 
      array (
        'format' => 'relative',
        'parameters' => '',
      ),
      'detail' => 
      array (
        'format' => 'relative',
        'parameters' => '',
      ),
      'default' => 'NOW()',
      'sortable' => '1',
      'disable' => '1',
    ),
    9 => 
    array (
      'label' => 'Updated',
      'name' => 'updated',
      'field' => 
      array (
        'type' => 'updated',
      ),
      'list' => 
      array (
        'format' => 'hide',
      ),
      'detail' => 
      array (
        'format' => 'hide',
      ),
      'default' => 'NOW()',
      'sortable' => '1',
      'disable' => '1',
    ),
    10 => 
    array (
      'label' => 'Remote Address',
      'name' => 'remote_address',
      'field' => 
      array (
        'type' => 'textarea',
      ),
      'validation' => 
      array (
        0 => 
        array (
          'method' => 'required',
          'message' => 'Remote Address is Required',
        ),
        1 => 
        array (
          'method' => 'empty',
          'message' => 'Cannot be empty',
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
  ),
  'relations' => 
  array (
    0 => 
    array (
      'disable' => '1',
      'many' => '1',
      'name' => 'profile',
    ),
  ),
  'suggestion' => '{{profile_name}}',
  'disable' => '1',
);