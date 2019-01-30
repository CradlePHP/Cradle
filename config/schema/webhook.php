<?php //-->
return array (
  'singular' => 'Webhook',
  'plural' => 'Webhooks',
  'name' => 'webhook',
  'group' => 'API',
  'icon' => 'fas fa-comments',
  'detail' => 'Manages Webhooks for applications registered on the system',
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
          'method' => 'required',
          'message' => 'Type is required',
        ),
        1 => 
        array (
          'method' => 'one',
          'parameters' => 
          array (
            0 => 'app',
            1 => 'user',
          ),
          'message' => 'Should be one of: app or user',
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
    2 => 
    array (
      'label' => 'Detail',
      'name' => 'detail',
      'field' => 
      array (
        'type' => 'markdown',
      ),
      'validation' => 
      array (
        0 => 
        array (
          'method' => 'required',
          'message' => 'Detail is required',
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
    3 => 
    array (
      'label' => 'Event Name',
      'name' => 'event',
      'field' => 
      array (
        'type' => 'text',
        'attributes' => 
        array (
          'placeholder' => 'ex. post-create',
        ),
      ),
      'validation' => 
      array (
        0 => 
        array (
          'method' => 'required',
          'message' => 'Event name is required',
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
    4 => 
    array (
      'label' => 'Parameters',
      'name' => 'parameters',
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
        'format' => 'jsonpretty',
      ),
      'default' => '',
      'disable' => '1',
    ),
    5 => 
    array (
      'label' => 'Method',
      'name' => 'method',
      'field' => 
      array (
        'type' => 'select',
        'options' => 
        array (
          0 => 
          array (
            'key' => 'get',
            'value' => 'GET',
          ),
          1 => 
          array (
            'key' => 'post',
            'value' => 'POST',
          ),
          2 => 
          array (
            'key' => 'put',
            'value' => 'PUT',
          ),
          3 => 
          array (
            'key' => 'delete',
            'value' => 'DELETE',
          ),
        ),
      ),
      'validation' => 
      array (
        0 => 
        array (
          'method' => 'required',
          'message' => 'Method is required',
        ),
        1 => 
        array (
          'method' => 'one',
          'parameters' => 
          array (
            0 => 'get',
            1 => 'post',
            2 => 'put',
            3 => 'delete',
          ),
          'message' => 'Should be one of: all, get, post, put or delete',
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
      'default' => 'all',
      'filterable' => '1',
      'disable' => '1',
    ),
    6 => 
    array (
      'label' => 'Action',
      'name' => 'action',
      'field' => 
      array (
        'type' => 'text',
        'attributes' => 
        array (
          'placeholder' => 'ex. post-create',
        ),
      ),
      'validation' => 
      array (
        0 => 
        array (
          'method' => 'required',
          'message' => 'Action is required',
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
    7 => 
    array (
      'label' => 'Sample Response',
      'name' => 'sample_response',
      'field' => 
      array (
        'type' => 'markdown',
        'attributes' => 
        array (
          'rows' => '10',
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
      'disable' => '1',
    ),
    8 => 
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
    9 => 
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
    10 => 
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
  'suggestion' => '{{webhook_title}}',
  'disable' => '1',
);