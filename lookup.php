<form action="lookup.php" method="post">
	Search IP: <input type="text" id="ipaddr" name="ipaddr" required><br>
	<button type="submit">Lookup</button>
</form><br><br>

<?php
if (isset($_POST['ipaddr'])) {
	$reverse_ip = implode(".", array_reverse(explode(".", $_POST['ipaddr'])));
	$domain = $reverse_ip.".bl.mxrbl.com";
		if(dns_check_record($domain, "A")) {
			echo "The submitted IP is blacklisted. <a href=\"mailto:removal@mxrbl.com\">Click here</a> to request removal.<br><br>DO NOT REQUEST REMOVAL FOR IP ADDRESSES THAT DO NOT HOST MAIL SERVERS.<br>DO NOT REQUEST REMOVAL FOR IP ADDRESSES THAT DO NOT HOST MAIL SERVERS!<br>DO NOT REQUEST REMOVAL FOR IP ADDRESSES THAT DO NOT HOST MAIL SERVERS!!<br>If you request the removal of a residential IP that does not run a mail server you will be ridiculed. If you do it repeatedly, you will be added to global spam filters. If you don't know why you shouldn't be asking for your residential IP to be removed from this list, you are not technically competent enough to know that this listing is not causing you problems.<br>";
			$reason = dns_get_record($domain, DNS_TXT);
			echo "<br>Reason(s) listed in database:<br><br>";
			foreach ($reason as $record) {
				echo $record['txt'] . "<br>";
			}
		} else {
			echo "The submitted IP is not blacklisted.";
		}
}
?>
<br><br>
<a href="index.php">Back</a>
