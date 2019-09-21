<ul class="pagination ">
  <li><?php echo $this->Paginator->prev(
   __('Previous'),
  array(),
  null,
  array('class' => 'page-item')
);?></li>
  <li><?php  echo $this->Paginator->numbers(array('separator' => null,'modulus' => '4','class' => 'page-item'));?></li>
  
<li> <?php echo $this->Paginator->next(
	('Next'),
  array(),
  null,
  array('class' => 'page-item')
);?></li>
</ul>