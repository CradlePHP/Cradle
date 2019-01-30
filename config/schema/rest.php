<?php //-->
return array (
  'singular' => 'REST Call',
  'plural' => 'REST Calls',
  'name' => 'rest',
  'group' => 'API',
  'icon' => 'fas fa-flask',
  'detail' => 'Manages REST calls for applications registered on the system',
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
            'key' => 'public',
            'value' => 'Public',
          ),
          1 => 
          array (
            'key' => 'app',
            'value' => 'App',
          ),
          2 => 
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
            0 => 'public',
            1 => 'app',
            2 => 'user',
          ),
          'message' => 'Should be one of: public, app or user',
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
      'default' => 'public',
      'filterable' => '1',
      'disable' => '1',
    ),
    2 => 
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
            'key' => 'all',
            'value' => 'ALL',
          ),
          1 => 
          array (
            'key' => 'get',
            'value' => 'GET',
          ),
          2 => 
          array (
            'key' => 'post',
            'value' => 'POST',
          ),
          3 => 
          array (
            'key' => 'put',
            'value' => 'PUT',
          ),
          4 => 
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
            0 => 'all',
            1 => 'get',
            2 => 'post',
            3 => 'put',
            4 => 'delete',
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
    3 => 
    array (
      'label' => 'Path',
      'name' => 'path',
      'field' => 
      array (
        'type' => 'text',
        'attributes' => 
        array (
          'placeholder' => 'ex. /post/search ... not including /rest',
        ),
      ),
      'validation' => 
      array (
        0 => 
        array (
          'method' => 'required',
          'message' => 'Path is required',
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
    5 => 
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
    6 => 
    array (
      'label' => 'Detail',
      'name' => 'detail',
      'field' => 
      array (
        'type' => 'markdown',
        'attributes' => 
        array (
          'rows' => '5',
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
    7 => 
    array (
      'label' => 'Sample Request',
      'name' => 'sample_request',
      'field' => 
      array (
        'type' => 'markdown',
        'attributes' => 
        array (
          'rows' => '5',
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
    9 => 
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
    10 => 
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
    11 => 
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
  'suggestion' => '{{rest_title}}',
  'disable' => '1',
);