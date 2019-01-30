<?php //-->
return array (
  'singular' => 'Scope',
  'plural' => 'Scopes',
  'name' => 'scope',
  'group' => 'API',
  'icon' => 'fas fa-crosshairs',
  'detail' => 'Groups API REST calls and Webhooks in order to swap in and out on the fly with out the developer necessarily updating their app. This is also useful for API versioning.',
  'fields' => 
  array (
    0 => 
    array (
      'label' => 'Name',
      'name' => 'name',
      'field' => 
      array (
        'type' => 'text',
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
          'data-source' => 'input[name=scope_name]',
          'data-lower' => '1',
          'data-space' => '_',
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
          'message' => 'Must be unique',
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
      'label' => 'Type',
      'name' => 'type',
      'field' => 
      array (
        'type' => 'select',
        'options' => 
        array (
          0 => 
          array (
            'key' => 'app',
            'value' => 'App',
          ),
          1 => 
          array (
            'key' => 'user',
            'value' => 'User',
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
            0 => 'app',
            1 => 'user',
          ),
          'message' => 'Should be one of public, app or user',
        ),
      ),
      'list' => 
      array (
        'format' => 'lower',
      ),
      'detail' => 
      array (
        'format' => 'lower',
      ),
      'default' => 'app',
      'filterable' => '1',
      'disable' => '1',
    ),
    3 => 
    array (
      'label' => 'Detail',
      'name' => 'detail',
      'field' => 
      array (
        'type' => 'markdown',
        'attributes' => 
        array (
          'rows' => '10',
          'placeholder' => 'Used for API Documentation',
        ),
      ),
      'list' => 
      array (
        'format' => 'hide',
      ),
      'detail' => 
      array (
        'format' => 'markdown',
      ),
      'default' => '',
      'searchable' => '1',
      'disable' => '1',
    ),
    4 => 
    array (
      'label' => 'Special Approval',
      'name' => 'special_approval',
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
          'message' => 'Should be 0 or 1',
        ),
        1 => 
        array (
          'method' => 'gte',
          'parameters' => '0',
          'message' => 'Should be 0 or 1',
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
  'relations' => 
  array (
    0 => 
    array (
      'disable' => '1',
      'many' => '2',
      'name' => 'rest',
    ),
  ),
  'suggestion' => '{{scope_name}}',
  'disable' => '1',
);