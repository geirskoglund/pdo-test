<?php
$sql = "SELECT user_role.id,
    user_role.role,
    user_role.weight
FROM user
";

echo "<!DOCTYPE html><html><head><title>Class Builder</title></head><body><pre>";

$arr = explode(",", $sql);
$props = array();

//Extract names
for($i=0;$i<count($arr);$i++)
{
	$val = trim($arr[$i]);
	$valSpace = explode(" ", $val);
	$val = $valSpace[(count($valSpace)-1)];
	$valPoint = explode(".", $val);
	$val = $valPoint[(count($valPoint)-1)];
	$arr[$i] = $val;
	
	$valUS = explode("_", $val);
	
	$props[$i] = $valUS[0];
	
	for($j=1; $j<count($valUS); $j++)
	{
		$props[$i] .= ucfirst($valUS[$j]);
	}
}

echo "class CLASSNAME extends DomainEntity
{";

$breakAt = 7;
$count=0;
$sep="
	protected";
foreach ($props as $prop)
{
	$count++;
	if($count%$breakAt==0)
		$break = "\n\t\t\t";
	else 
		$break="";
	
	echo "$sep $break\$$prop";
	$sep = ",";
}
echo ";";

echo "
	
	function fill(array \$row)
	{";

for($i=0;$i<count($arr);$i++)
{
	echo "
		\$this->$props[$i] = \$row[\"$arr[$i]\"];";
}

echo "
	}
";

foreach ($props as $prop)
{
	echo "
	public function get".ucfirst($prop) . "()
	{
		return \$this->$prop;		
	}
	
	//public function set".ucfirst($prop) . "(\$value)
	//{
	//	\$this->$prop = \$value;
	//}
	";
}

echo "
}";

// echo "
		
// 	private function bindEntityToArray(&\$statement, &\$row)
// 	{
// 		\$statement->bind_result(";

// 	$delim="";
// 	foreach ($arr as $val)
// 	{
// 		echo $delim . "\$row[\"$val\"]";
// 		$delim = ", ";	
// 	}
	
// 	echo ");
// 	}
// 	";

echo "</pre></body>";
