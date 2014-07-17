<?php $this->beginContent('//layouts/title');$this->endContent(); ?>
<body class="page-item">
<!--#include virtual="/inc-site/body-begin.shtml" wait="yes"-->
<?php $this->beginContent('//layouts/header');$this->endContent(); ?>
<?php $this->beginContent('//layouts/dota2');$this->endContent(); ?>
	<?php echo $content; ?>
<?php $this->beginContent('//layouts/history');$this->endContent(); ?>
<?php $this->beginContent('//layouts/footer');$this->endContent(); ?>
