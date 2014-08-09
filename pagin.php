<?php
function pagination()
{
	$limit = 5;
	//$ID = $_POST['id'];
	$ID = getId();
	$targetPage = 'notes.php';
	$c = DB::getConn();
	$getTotPage = $c->query("SELECT COUNT(*) AS 'num' FROM `enote`.`notes` WHERE `user_id` = '$ID'");
	$totalPage = $getTotPage->fetch(PDO::FETCH_ASSOC);
	$totalPage = $totalPage['num'];
	
	$stages = 3;
	$page = $_GET['page'];
	if ($page)
	{
		$start = ($page - 1) * $limit;	
	}
	else
	{
		$start = 0;
	}

	if ($page == 0)
	{
		$page = 1;
	}
	$prev = $page - 1;
	$next = $page +1;
	$lastPage = ceil($totalPage/$limit);
	$lastPagem = $lastPage - 1;

	$paginate = '';
	if ($lastPage > 1)
	{
		$paginate .= "<div>";
		if ($page > 1)
		{
			$paginate .= "<a href = '$targetPage?page = $page'> <<< </a>";
		}
		if ($lastPage < 7 + ($stages * 2))
		{
			for ($counter = 1; $counter <= $lastPage; $counter++) 
			{ 
				if ($counter == $page)
				{
					$paginate .= "<span> " . $counter . " </span>";
				}
				else
				{
					$paginate .= "<a href='$targetpage?page=$counter'>$counter</a>";
				}	
			}
		}
		elseif ($lastPage > 5 + ($stages * 2)) 
		{
			if ($page < 1 + ($stages * 2))
			{
				for ($counter = 1; $counter < 4 + ($stages * 2); $counter++)
				{
					if ($counter == $page)
					{
						$paginate .= "<span> " . $counter . " </span>";
					}
					else
					{
						$paginate .= "<a href='$targetpage?page=$counter'>$counter</a>";
					}	
				}
				$paginate .= "...";
				$paginate .= "<a href='$targetpage?page=$LastPagem'>$LastPagem</a>";
				$paginate .= "<a href='$targetpage?page=$lastPage'>$lastPage</a>";
			}
			elseif ($lastPage - ($stages * 2) > $page && $page > ($stages * 2))
			{
				$paginate .= "<a href='$targetpage?page=1'>1</a>";
				$paginate .= "<a href='$targetpage?page=2'>2</a>";
				$paginate .= "...";
				for ($counter = $page - $stages; $counter <= $page + $stages; $counter++)
				{
					if ($counter == $page)
					{
						$paginate .= "<span> " . $counter . " </span>";
					}
					else
					{
						$paginate .= "<a href='$targetpage?page=$counter'>$counter</a>";
					}
				}
				$paginate .= "...";
				$paginate .= "<a href='$targetpage?page=$LastPagem'>$LastPagem</a>";
				$paginate .= "<a href='$targetpage?page=$lastPage'>$lastPage</a>";
			}
			else
			{
				$paginate .= "<a href='$targetpage?page=1'>1</a>";
				$paginate .= "<a href='$targetpage?page=2'>2</a>";
				$paginate .= "...";
				for ($counter = $lastPage - (2 + ($stages * 2)); $counter <= $lastPage; $counter++)
				{
					if ($counter == $page)
					{
						$paginate .= "<span> " . $counter . " </span>";
					}
					else
					{
						$paginate .= "<a href='$targetpage?page=$counter'>$counter </a>";
					}
				}
			}
		}
		if ($page < $counter - 1)
		{ 
			$paginate .= "<a href='$targetpage?page=$next '> >>> </a>";
		}
		
	$paginate.= "</div>";		
	}
	$_POST['paginate'] = $paginate;
	$_POST['start'] = $start;
	$_POST['limit'] = $limit;
}
?>