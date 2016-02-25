<?php

function site_header ($title, $auth_list="")
{
    echo "<!DOCTYPE html PUBLIC \"-//W3C//DTD HTML 4.01 Transitional//EN\" \"http://www.w3.org/TR/html4/loose.dtd\">\n\n";
    echo "<head>\n\n";
    echo "   <meta http-equiv=\"Content-Type\" content=\"text/html;charset=utf-8\"/>\n";
    echo "	<title>".$title."</title>\n\n";
    echo "	<link rel=\"stylesheet\" type=\"text/css\" href=\"block_crawler.css\">\n\n";
    echo "</head>\n";
    echo "<body>\n";
    echo "\n";
    echo "	<div id=\"site_head\">\n";
    echo "\n";
    echo "		<div id=\"site_head_logo\">\n";
    echo "\n";
    
    echo "			<h1><a href=\"".$_SERVER["PHP_SELF"]."\" title=\"首页\">\n";
    echo "				区块浏览器\n";
    echo "			</a></h1>\n";
    echo "			<h3><a href=\"".$_SERVER["PHP_SELF"]."\" title=\"首页\">\n";
    echo "				首页\n";
    echo "			</a></h3>\n";
    echo "\n";
    
    echo "		</div>\n";
    echo "\n";
    
    echo "	</div>\n";
    echo "\n";
    
    echo "	<div id=\"page_wrap\">\n";
    echo "\n";
}

function site_footer ()
{
    //	The page_wrap div is opened in the last line of the site_header function.	
    echo "	</div>\n";
    echo "\n";
    echo "	<div id=\"donor_box\">\n";
    echo "\n";
    echo "		技术支持由 <a target=\"_blank\"href=\"http://www.zaobi.org\">zaobi.org</a> 提供<p>QQ 260682605</p> \n";
    echo "	</div>\n";
    echo "\n";
    echo "</body>\n";
    echo "</html>";
    exit;
}

function block_detail ($block_id, $hash=FALSE)
{
    $network_info = getinfo ();
    if ($hash == TRUE)
    {
	$raw_block = getblock ($block_id);
    }
    else
    {
	$block_hash = getblockhash (intval ($block_id));
	$raw_block = getblock ($block_hash);
    }
    
    echo "	<div class=\"block_banner\">\n";
    echo "\n";
    
    echo "		<div class=\"blockbanner_left\">\n";
    echo "			块高度: ".$raw_block["height"]."\n";
    echo "		</div>\n";
    echo "\n";
    
    echo "		<div class=\"blockbanner_right\">\n";
    echo "			出块时间: ".$raw_block["time"]."\n";
    echo "		</div>\n";
    echo "\n";
    echo "	</div>\n";
    echo "\n";

    echo "	<div class=\"blockdetail\">\n";
    echo "\n";
    echo "		<div class=\"blockdetail_detail\">\n";
    echo "			<div class=\"blockdetail_header\">出币数</div>\n";		
    echo "			<div class=\"blockdetail_content\">\n";
    echo "				".$raw_block["mint"]."\n";
    echo "			</div>\n";
    echo "		</div>\n";
    echo "\n";
    
    echo "		<div class=\"blockdetail_detail\">\n";
    echo "			<div class=\"blockdetail_header\">块大小</div>\n";		
    echo "			<div class=\"blockdetail_content\">\n";
    echo "				".$raw_block["size"]."\n";
    echo "			</div>\n";
    echo "		</div>\n";
    echo "\n";
    
    echo "		<div class=\"blockdetail_detail\">\n";
    echo "			<div class=\"blockdetail_header\">确认数</div>\n";		
    echo "			<div class=\"blockdetail_content\">\n";
    echo "				".(intval($network_info["blocks"])-intval($raw_block["height"])+1)."\n";
    echo "			</div>\n";
    echo "		</div>\n";
    echo "\n";

    echo "	</div>\n";
    echo "\n";
    
    echo "	<div class=\"blockdetail\">\n";
    echo "\n";
    
    echo "		<div class=\"blockdetail_detail\">\n";
    echo "			<div class=\"blockdetail_header\">Block Bits</div>\n";		
    echo "			<div class=\"blockdetail_content\">\n";
    echo "				".$raw_block["bits"]."\n";
    echo "			</div>\n";
    echo "		</div>\n";
    echo "\n";
    
    echo "		<div class=\"blockdetail_detail\">\n";
    echo "			<div class=\"blockdetail_header\">块随机数</div>\n";		
    echo "			<div class=\"blockdetail_content\">\n";
    echo "				".$raw_block["nonce"]."\n";
    echo "			</div>\n";
    echo "		</div>\n";
    echo "\n";
    
    echo "		<div class=\"blockdetail_detail\">\n";
    echo "			<div class=\"blockdetail_header\">块难度</div>\n";		
    echo "			<div class=\"blockdetail_content\">\n";
    echo "				".$raw_block["difficulty"]."\n";
    echo "			</div>\n";
    echo "		</div>\n";
    echo "\n";
    echo "	</div>\n";
    echo "\n";
    
    detail_display ("Merkle Root", $raw_block["merkleroot"]);
    
    detail_display ("块 Hash", blockhash_link ($raw_block["hash"]));
    
    echo "	<div class=\"blocknav\">\n";
    echo "\n";
    
    echo "		<div class=\"blocknav_prev\">\n";
    echo "			<a href=\"".$_SERVER["PHP_SELF"]."?block_hash=".$raw_block["previousblockhash"]."\" title=\"View Previous Block\"><- 上一块</a>\n";
    echo "		</div>\n";
    echo "\n";
    
    echo "		<div class=\"blocknav_news\">\n";
    echo "			出块时间: ".$raw_block["time"]."\n";
    echo "		</div>\n";
    echo "\n";
    
    echo "		<div class=\"blocknav_next\">\n";
    echo "			<a href=\"".$_SERVER["PHP_SELF"]."?block_hash=".$raw_block["nextblockhash"]."\" title=\"View Next Block\">下一块 -></a>\n";
    echo "		</div>\n";
    echo "\n";
    
    echo "	</div>\n";
    echo "\n";
    
    echo "	<div class=\"txlist_header\">\n";
    echo "		查看块中的交易\n";		
    echo "	</div>\n";
    echo "\n";
    
    echo "	<div class=\"txlist_wrap\">\n";
    
    foreach ($raw_block["tx"] as $index => $tx)
    {
			echo "		<div class=\"txlist_showtx\" id=\"showtx_".$index."\">\n";
			echo "			<a href=\"".$_SERVER["PHP_SELF"]."?transaction=".$tx."\" title=\"交易详情\">\n";
			echo "				".$tx."\n";
			echo "			</a>\n";
			echo "		</div>\n\n";
		}
		
		echo "	</div>\n";
		echo "\n";
		
	}
	
	function tx_detail ($tx_id)
	{
		$raw_tx = getrawtransaction ($tx_id);
		
		section_head ("交易ID: ".$raw_tx["txid"]);
		
		section_subhead ("详情描述");

		detail_display ("交易版本号", $raw_tx["version"]);
		
		detail_display ("交易时间", date ("F j, Y, H:i:s", $raw_tx["time"]));
		
		detail_display ("锁定时间", $raw_tx["locktime"]);
		
		detail_display ("确认数", $raw_tx["confirmations"]);
		
		detail_display ("块Hash", blockhash_link ($raw_tx["blockhash"]));
		
	//	Florin Coin Feature
		if (isset ($raw_tx["tx-comment"]) && $raw_tx["tx-comment"] != "")
		{
			detail_display ("交易消息", htmlspecialchars ($raw_tx["tx-comment"]));
		}
		
		detail_display ("HEX 数据", $raw_tx["hex"], 50);
		
		section_head ("交易输入");		
		
		foreach ($raw_tx["vin"] as $key => $txin)
		{
			section_subhead ("交易输入 ".$key);

			if (isset ($txin["coinbase"]))
			{
				detail_display ("Coinbase", $txin["coinbase"]);
		
				detail_display ("Sequence", $txin["sequence"]);
			}
			
			else
			{
				detail_display ("TX ID", tx_link ($txin["txid"]));
		
				detail_display ("TX Output", $txin["vout"]);
		
				detail_display ("TX Sequence", $txin["sequence"]);
		
				detail_display ("Script Sig (ASM)", $txin["scriptSig"]["asm"], 50);
		
				detail_display ("Script Sig (HEX)", $txin["scriptSig"]["hex"], 50);
			}
		}
		
		section_head ("交易输出");
		
		foreach ($raw_tx["vout"] as $key => $txout)
		{
			section_subhead ("交易输出 ".$key);
		
			detail_display ("交易金额", $txout["value"]);
		
			detail_display ("交易类型", $txout["scriptPubKey"]["type"]);
		
			detail_display ("是否要求签名", $txout["scriptPubKey"]["reqSigs"]);
		
			detail_display ("Script Pub Key (ASM)", $txout["scriptPubKey"]["asm"], 50);
		
			detail_display ("Script Pub Key (HEX)", $txout["scriptPubKey"]["hex"], 50);
		
			if (isset ($txout["scriptPubKey"]["addresses"]))
			{
				foreach ($txout["scriptPubKey"]["addresses"] as $key => $address);
				{
					detail_display ("地址 ".$key, $address);
				}
			}
			
 		}
		
		section_head ("原始交易详情");
		
		echo "	<textarea name=\"rawtrans\" rows=\"25\" cols=\"80\" style=\"text-align:left;\">\n";
		print_r ($raw_tx);
		echo "	\n</textarea><br><br>\n";
	}

	function detail_display ($title, $data, $wordwrap=0)
	{
		echo "	<div class=\"detail_display\">\n";
	        echo "		<div class=\"detail_title\">\n";
		echo "			".$title."\n";
		echo "		</div>\n";

		if ($wordwrap > 0)
		{
			echo "		<div class=\"detail_data\">\n";
			echo "			".wordwrap ($data, $wordwrap, "<br>", TRUE)."\n";
			echo "		</div>\n";
		}
		
		else
		{
			echo "		<div class=\"detail_data\">\n";
			echo "			".$data."\n";
			echo "		</div>\n";
		}
		
		echo "	</div>\n";
	}

	function tx_link ($tx_id)
	{
		return "<a href=\"".$_SERVER["PHP_SELF"]."?transaction=".$tx_id."\" title=\"View Transaction Details\">".$tx_id."</a>\n";
	}

	function blockheight_link ($block_height)
	{
		return "<a href=\"".$_SERVER["PHP_SELF"]."?block_height=".$block_height."\" title=\"View Block Details\">".$block_height."</a>\n";
	}

	function blockhash_link ($block_hash)
	{
		return "<a href=\"".$_SERVER["PHP_SELF"]."?block_hash=".$block_hash."\" title=\"View Block Details\">".$block_hash."</a>\n";
	}

	function section_head ($heading)
	{
		echo "		<div class=\"section_head\">\n";
		echo "			".$heading."\n";
		echo "		</div>\n";
		echo "\n";
	}
	
	function section_subhead ($heading)
	{
		echo "		<div class=\"section_subhead\">\n";
		echo "			".$heading."\n";
		echo "		</div>\n";
		echo "\n";
	}
	
/******************************************************************************
	This script is Copyright © 2013 Jake Paysnoe.
	I hereby release this script into the public domain.
	Jake Paysnoe Jun 26, 2013
******************************************************************************/
?>
