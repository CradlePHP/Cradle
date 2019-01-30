<?php //-->
return array (
  'singular' => 'Article',
  'plural' => 'Articles',
  'name' => 'article',
  'group' => 'Content',
  'icon' => 'fas fa-newspaper',
  'detail' => 'Manages articles in the system.',
  'fields' => 
  array (
    0 => 
    array (
      'label' => 'Title',
      'name' => 'title',
      'field' => 
      array (
        'type' => 'text',
        'attributes' => 
        array (
          'placeholder' => 'eg. Spam is the new Wagyu',
        ),
      ),
      'validation' => 
      array (
        0 => 
        array (
          'method' => 'required',
          'message' => 'Title is required.',
        ),
      ),
      'list' => 
      array (
        'format' => 'capital',
      ),
      'detail' => 
      array (
        'format' => 'capital',
      ),
      'default' => '',
      'searchable' => '1',
    ),
    1 => 
    array (
      'label' => 'Detail',
      'name' => 'detail',
      'field' => 
      array (
        'type' => 'wysiwyg',
        'attributes' => 
        array (
          'rows' => '10',
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
        'format' => 'hide',
      ),
      'detail' => 
      array (
        'format' => 'html',
      ),
      'default' => '',
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
            'value' => 'Pending',
          ),
          1 => 
          array (
            'key' => 'reviewed',
            'value' => 'Reviewed',
          ),
          2 => 
          array (
            'key' => 'published',
            'value' => 'Published',
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
            1 => 'reviewed',
            2 => 'published',
          ),
          'message' => 'Should be one of pending, reviewed, published',
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
      'default' => 'pending',
      'filterable' => '1',
    ),
    3 => 
    array (
      'label' => 'Published',
      'name' => 'published',
      'field' => 
      array (
        'type' => 'datetime',
      ),
      'list' => 
      array (
        'format' => 'relative',
        'parameters' => 'F d, Y g:iA',
      ),
      'detail' => 
      array (
        'format' => 'relative',
        'parameters' => 'F d, Y g:iA',
      ),
      'default' => '',
      'sortable' => '1',
    ),
    4 => 
    array (
      'label' => 'References',
      'name' => 'references',
      'field' => 
      array (
        'type' => 'fieldset',
        'parameters' => 'reference',
        'attributes' => 
        array (
          'data-multiple' => '0',
        ),
      ),
      'list' => 
      array (
        'format' => 'hide',
      ),
      'detail' => 
      array (
        'format' => 'table',
      ),
      'default' => '',
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
  'suggestion' => '{{article_title}}',
);