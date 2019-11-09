<?php
// 跟TP框架中的C函数冲突了，改下名字就行
function CC($className)
{
	return LtObjectUtil::singleton($className);
}
