<?php

require_once ("bc_daemon.php");
require_once ("bc_layout.php");

//	If a block hash was provided the block detail is shown
if (isset ($_REQUEST["block_hash"]))
{
    site_header ("区块详情页");
    block_detail ($_REQUEST["block_hash"], TRUE);
}

//	If a block height is provided the block detail is shown
elseif (isset ($_REQUEST["block_height"]))
{
    site_header ("区块详情页");
    block_detail ($_REQUEST["block_height"]);
}

//	If a TXid was provided the TX Detail is shown
elseif (isset ($_REQUEST["transaction"]))
{
    site_header ("交易详情页");
    tx_detail ($_REQUEST["transaction"]);
}

//	If there were no request parameters the menu is shown
else
{
    site_header ("首页");
    
    echo "	<div id=\"node_info\">\n";
    echo "\n";
    
    $network_info = getinfo ();
    
    echo "		<div class=\"node_detail\">\n";
    echo "			<span class=\"node_desc\">总区块数:</span><br>\n";
    echo "			".$network_info["blocks"]."\n";
    echo "		</div>\n";
    echo "\n";

    echo "		<div class=\"node_detail\">\n";
    echo "			<span class=\"node_desc\">难度:</span><br>\n";
    echo "			".$network_info["difficulty"]."\n";
    echo "		</div>\n";
    echo "\n";

    echo "		<div class=\"node_detail\">\n";
    echo "			<span class=\"node_desc\">连接数:</span><br>\n";
    echo "			".$network_info["connections"]."\n";
    echo "		</div>\n";
    echo "\n";

    $net_speed = getnetworkghashps ();
    
    if ($net_speed != "")
    {
	echo "		<div class=\"node_detail\">\n";
	echo "			<span class=\"node_desc\">网络算力 GH/s:</span><br>\n";
	echo "			".$net_speed."\n";
	echo "		</div>\n";
	echo "\n";
    }
    
    echo "	</div>\n";
    echo "\n";

    echo "	<div id=\"site_menu\">\n";
    echo "\n";
    
    echo "		<div class=\"menu_item\">\n";
    echo "			<span class=\"menu_desc\">输入一个块的索引/高度(如:100)</span><br>\n";
    echo "			<form action=\"".$_SERVER["PHP_SELF"]."\" method=\"post\">\n";
    echo "				<input type=\"text\" name=\"block_height\" size=\"40\">\n";
    echo "				<input type=\"submit\" name=\"submit\" value=\"查看块\">\n";
    echo "			</form>\n";
    echo "		</div>\n";
    echo "\n";

    echo "		<div class=\"menu_item\">\n";
    echo "			<span class=\"menu_desc\">输入一个块的散列值</span><br>\n";
    echo "			<form action=\"".$_SERVER["PHP_SELF"]."\" method=\"post\">\n";
    echo "				<input type=\"text\" name=\"block_hash\" size=\"40\">\n";
    echo "				<input type=\"submit\" name=\"submit\" value=\"查看块\">\n";
    echo "			</form>\n";
    echo "		</div>\n";
    echo "\n";

    echo "		<div class=\"menu_item\">\n";
    echo "			<span class=\"menu_desc\">输入一个交易ID</span><br>\n";
    echo "			<form action=\"".$_SERVER["PHP_SELF"]."\" method=\"post\">\n";
    echo "				<input type=\"text\" name=\"transaction\" size=\"40\">\n";
    echo "					<input type=\"submit\" name=\"submit\" value=\"查看交易\">\n";
    echo "			</form>\n";
    echo "		</div>\n";
    echo "\n";

    echo "	</div>\n";
    echo "\n";
}


site_footer ();

/******************************************************************************
   This script is Copyright © 2013 Jake Paysnoe.
   I hereby release this script into the public domain.
   Jake Paysnoe Jun 26, 2013
 ******************************************************************************/
?>
