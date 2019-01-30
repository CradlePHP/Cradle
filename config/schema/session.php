<?php //-->
return array (
  'singular' => 'Session',
  'plural' => 'Sessions',
  'name' => 'session',
  'group' => 'API',
  'icon' => 'fas fa-id-card',
  'detail' => 'Manages 3-legged application sessions',
  'fields' => 
  array (
    0 => 
    array (
      'label' => 'Token',
      'name' => 'token',
      'field' => 
      array (
        'type' => 'uuid',
      ),
      'list' => 
      array (
        'format' => 'none',
      ),
      'detail' => 
      array (
        'format' => 'none',
      ),
      'default' => '1',
      'searchable' => '1',
      'filterable' => '1',
      'disable' => '1',
    ),
    1 => 
    array (
      'label' => 'Secret',
      'name' => 'secret',
      'field' => 
      array (
        'type' => 'uuid',
      ),
      'list' => 
      array (
        'format' => 'none',
      ),
      'detail' => 
      array (
        'format' => 'none',
      ),
      'default' => '1',
      'searchable' => '1',
      'filterable' => '1',
      'disable' => '1',
    ),
    2 => 
    array (
      'label' => 'Status',
      'name' => 'status',
      'field' => 
      array (
        'type' => 'select',
        'options' => 
        array (
          0 => 
          array (
            'key' => 'pending',
            'value' => 'PENDING',
          ),
          1 => 
          array (
            'key' => 'access',
            'value' => 'ACCESS',
          ),
        ),
      ),
      'validation' => 
      array (
        0 => 
        array (
          'method' => 'one',
          'parameters' => 
          array (
            0 => 'pending',
            1 => 'access',
          ),
          'message' => 'Should be one of: pending or access',
        ),
      ),
      'list' => 
      array (
        'format' => 'upper',
      ),
      'detail' => 
      array (
        'format' => 'upper',
      ),
      'default' => 'pending',
      'filterable' => '1',
      'sortable' => '1',
      'disable' => '1',
    ),
    3 => 
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
    4 => 
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
    5 => 
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
  'relations' => 
  array (
    0 => 
    array (
      'disable' => '1',
      'many' => '1',
      'name' => 'app',
    ),
    1 => 
    array (
      'disable' => '1',
      'many' => '1',
      'name' => 'profile',
    ),
    2 => 
    array (
      'disable' => '1',
      'many' => '2',
      'name' => 'scope',
    ),
  ),
  'suggestion' => '{{app_title}} - {{profile_name}} - {{session_token}}',
  'disable' => '1',
);