<?php

// For the_resumer module

// The PARSER
// Writing the Parser Engine
//function the_parser($contents)
function the_parser1($contents)
{
	// Regex Right, to some extent
	//preg_match_all ('/:::.*:::.*[^:.*:].*/', $contents, $arrSubPat);
	// Regex Wrong
	//preg_match_all ('/:::.*:::.*[^:.*:].*/', $contents, $arrSubPat);
	
	// for the moment
	// THIS
	//preg_match_all ('/:::(.*):::/', $contents, $arrSubPat);
	
	
	//preg_match_all('/~~~(.*)~~~/', $contents, $arrSubPat);
	preg_match_all('/~(.*)~/', $contents, $arrSubPat2);
	
	
	
	//printrr($arrSubPat);
	//printrr($arrSubPat2);
	
	
	return $arrSubPat;
	
}

//=================

//function the_parser2($contents)
function the_parser($contents)
{
	
	//printrr($contents);
	
	// THIS Almost Awesome
	///preg_match_all('/~~.*~~[^~]*/', $contents, $arrS);
	
	// Here comes the Awesome Awesome!
	preg_match_all('/~.*~[^~]+/', $contents, $arrSub);
	
	//printrr($arrS);
	
	//$a = explode(PHP_EOL, $contents);
	//printrr($a);
	
	//createNode($arrSub);
	
	return $arrSub;
}


//function createNode1($arr)
function createNode($arr)
{
	
	//printrr($arr);
	
	$i=-1;
	$j=0;
	$h=0;
	
	$arrSub = array();
	
	foreach($arr[0] as $k => $v)
	{
		
		//if(preg_match_all('/~~~.*~~~/', $v, $arrSub) )
		if(preg_match('/~~~(.*)~~~([^~]+)/', $v, $arrSub[$k]))
		{
			$i++;
			//$newArr[$i]['node']['title'] = $arrSub[$k][1];
			//$newArr[$i]['node']['desc'] = $arrSub[$k][2];
			
			$newArr['node'][$i]['title'] = $arrSub[$k][1];
			$newArr['node'][$i]['desc'] = $arrSub[$k][2];
			
			continue;
		}
		
		if(preg_match('/~~([^~]+)~~([^~]+)/', $v, $arrSub2[$k]))
		{
			//$newArr[$i]['node']['node2'][$j]['title'] = $arrSub2[$k][1];
			//$newArr[$i]['node']['node2'][$j]['desc'] = $arrSub2[$k][2];
			
			$newArr['node'][$i]['node'][$j]['title'] = $arrSub2[$k][1];
			$newArr['node'][$i]['node'][$j]['desc'] = $arrSub2[$k][2];
			
			$j++;
			continue;
		}
		
		if(preg_match('/~([^~]+)~([^~]+)/', $v, $arrSub3[$k]))
		{
			//$newArr[$i]['node']['node2']['node3'][$h]['title'] = $arrSub3[$k][1];
			//$newArr[$i]['node']['node2']['node3'][$h]['desc'] = $arrSub3[$k][2];
			
			$newArr['node'][$i]['node'][$j]['node'][$h]['title'] = $arrSub3[$k][1];
			$newArr['node'][$i]['node'][$j]['node'][$h]['desc'] = $arrSub3[$k][2];
			
			$h++;
			continue;
		}
		
	}
	
	//printrr($newArr);
	//echo 'NODE:';
	//printrr($arrSub);
	
	return $newArr;
}


//function createNode($arr)
function createNode2($arr)
{
	
	//printrr($arr);
	
	$i = 3;
	
	$arrSub = array();
	foreach($arr[0] as $k => $v)
	{
		
		//if(preg_match_all('/~~~.*~~~/', $v, $arrSub) )
		if(preg_match('/~{'.$i.','.$i.'}(.*)~{3,3}([^~]+)/', $v, $arrSub[$k]))
		{
			$newArr[$k]['node']['title'] = $arrSub[$k][1];
			$newArr[$k]['node']['desc'] = $arrSub[$k][2];
		}
		
		
		
		
		
		
		
	}
	
	printrr($newArr);
	
	//echo 'NODE:';
	//printrr($arrSub);
	
	
}

//=================


function the_parser3($contents)
{
	
	//printrr($contents);
	
	// THIS Almost Awesome
	///preg_match_all('/~~.*~~[^~]*/', $contents, $arrS);
	
	// Here comes the Awesome Awesome!
	preg_match_all('/~.*~[^~]+/', $contents, $arrS);
	
	printrr($arrS);
	
	//createNode($arrS);
	
}


//=================

// Parse each word,
// If a word matches with the word Java(1st word in dictionary)
// that means the words in that area of the string are matching the language dictionary wordlist,
// so go back 10 words in the string and start matching for each word in dictionary wordlist
// if a word again matches, then again go 10(probably less, maybe 8 words) 
// and start matching again, if it again match, go back probably 7 words.
// now when it stops matching, 
// start matching all dictionary wordlist from that point in the string
// In this way, you wont have to match each dictionary wordlist through the whole string 
function algo1($contents)
{
	global $availImgs;
	
	echo $contents;
	
}

?>

