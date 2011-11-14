<?php

class myUser extends sfGuardSecurityUser
{
	public function getProjects() {
		return ProjectTable::getInstance()->findAll();
	}
}
