<?php //-->
return array (
  'singular' => 'Comment',
  'plural' => 'Comments',
  'name' => 'comment',
  'group' => 'Content',
  'icon' => 'fas fa-comment',
  'detail' => 'Manages article comments in the system.',
  'fields' => 
  array (
    0 => 
    array (
      'label' => 'Rating',
      'name' => 'rating',
      'field' => 
      array (
        'type' => 'stars',
      ),
      'list' => 
      array (
        'format' => 'stars',
      ),
      'detail' => 
      array (
        'format' => 'stars',
      ),
      'default' => '0.0',
      'sortable' => '1',
    ),
    1 => 
    array (
      'label' => 'Detail',
      'name' => 'detail',
      'field' => 
      array (
        'type' => 'textarea',
        'attributes' => 
        array (
          'rows' => '5',
        ),
      ),
      'validation' => 
      array (
        0 => 
        array (
          'method' => 'required',
          'message' => 'Detail is required.',
        ),
      ),
      'list' => 
      array (
        'format' => 'strip',
        'parameters' => '<b><em>',
      ),
      'detail' => 
      array (
        'format' => 'strip',
        'parameters' => '<b><em>',
      ),
      'default' => '',
      'searchable' => '1',
    ),
    2 => 
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
    ),
    3 => 
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
    ),
    4 => 
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
    ),
  ),
  'relations' => 
  array (
    0 => 
    array (
      'many' => '1',
      'name' => 'profile',
    ),
    1 => 
    array (
      'many' => '2',
      'name' => 'comment',
    ),
  ),
  'suggestion' => '{{comment_detail}}',
);