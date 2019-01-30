<?php //-->
return array (
  'singular' => 'Application',
  'plural' => 'Applications',
  'name' => 'app',
  'group' => 'API',
  'icon' => 'fas fa-mobile-alt',
  'detail' => 'Manages Applications',
  'fields' => 
  array (
    0 => 
    array (
      'label' => 'Title',
      'name' => 'title',
      'field' => 
      array (
        'type' => 'text',
      ),
      'validation' => 
      array (
        0 => 
        array (
          'method' => 'required',
          'message' => 'Title is required',
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
      'label' => 'Domain',
      'name' => 'domain',
      'field' => 
      array (
        'type' => 'text',
        'attributes' => 
        array (
          'placeholder' => 'ex. foo.bar.com',
        ),
      ),
      'validation' => 
      array (
        0 => 
        array (
          'method' => 'required',
          'message' => 'Domain is required',
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
      'label' => 'Website',
      'name' => 'website',
      'field' => 
      array (
        'type' => 'url',
      ),
      'list' => 
      array (
        'format' => 'link',
        'parameters' => 
        array (
          0 => '{{app_website}}',
          1 => '{{app_website}}',
        ),
      ),
      'detail' => 
      array (
        'format' => 'link',
        'parameters' => 
        array (
          0 => '{{app_website}}',
          1 => '{{app_website}}',
        ),
      ),
      'default' => '',
      'searchable' => '1',
      'disable' => '1',
    ),
    3 => 
    array (
      'label' => 'Webhook URL',
      'name' => 'webhook',
      'field' => 
      array (
        'type' => 'url',
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
      'disable' => '1',
    ),
    4 => 
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
    5 => 
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
    6 => 
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
    7 => 
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
    8 => 
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
      'name' => 'profile',
    ),
    1 => 
    array (
      'disable' => '1',
      'many' => '2',
      'name' => 'scope',
    ),
    2 => 
    array (
      'disable' => '1',
      'many' => '2',
      'name' => 'webhook',
    ),
  ),
  'suggestion' => '{{app_title}}',
  'disable' => '1',
);