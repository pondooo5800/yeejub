<html>
<head>
	<style>
		body {
			font-family: thsarabun;
			font-size: 16pt;
		}

		p {
			margin: 0pt;
		}

		table.items {
			border: 0.1mm solid #000000;
		}

		td {
			vertical-align: top;
		}

		.items td {
			border-left: 0.1mm solid #000000;
			border-right: 0.1mm solid #000000;
			border-bottom: 0.1mm solid #000000;
		}

		table thead td {
			background-color: #EEEEEE;
			text-align: center;
			border: 0.1mm solid #000000;
			font-variant: small-caps;
		}

		.items td.blanktotal {
			background-color: #EEEEEE;
			border: 0.1mm solid #000000;
			background-color: #FFFFFF;
			border: 0mm none #000000;
			border-top: 0.1mm solid #000000;
			border-right: 0.1mm solid #000000;
		}

		.items td.totals {
			text-align: right;
			border: 0.1mm solid #000000;
		}

		.items td.cost {
			text-align: "."center;
		}

		.footer {
			position: fixed;
			padding-left: 10px;
			padding-top: 10px;
			left: 0;
			bottom: 0;
			width: 100%;
			color: #000000;
			text-align: left;
			font-size: 12pt;
			border-top: 0.1mm solid #808080;
		}
	</style>
</head>

<body>
	<div class="container-fluid">
		<div class="container">
			<div style="text-align: left; font-weight: bold;font-family: thsarabun; font-size: 22pt; color:#3366cc">
				YEEYUB.COM | ร้านหยี่จ๊ับ
			</div>
			<div style="text-align: center;">
				<p><span style="font-weight: bold;font-size: 18pt;">ใบสั่งซื้อสินค้า</span></p>
			</div>
			<div>
				<div style="float: right; width: 50%;text-align: right;">
				<p style="font-weight: bold;font-size: 14pt;">หมายเลขใบสั่งซื้อ <span style="font-weight: normal;font-size: 14pt;">#<?php echo $order['id'];?></span></p>
				<p style="font-weight: bold;font-size: 14pt;">วันที่ส่ังสินค้า <span style="font-weight: normal;font-size: 14pt;"><?php echo setThaiDateFullMonth($order['created']); ?></span></p>
				</div>
				<div style="float: left; width: 50%;">
				<p style="font-weight: bold;font-size: 14pt;">รหัสสมาชิก <span style="font-weight: normal;font-size: 14pt;"><?php echo $order['member_user_id'];?></span></p>
				<p style="font-weight: bold;font-size: 14pt;">ชื่อ-สกุล <span style="font-weight: normal;font-size: 14pt;"><?php echo $order['name'];?></span></p>
				<p style="font-weight: bold;font-size: 14pt;">เบอร์โทร <span style="font-weight: normal;font-size: 14pt;"><?php echo $order['phone'];?></span></p>
				<p style="font-weight: bold;font-size: 14pt;">สถานที่จัดสินค้า <span style="font-weight: normal;font-size: 14pt;"><?php echo $order['member_addr'];?></span></p>
				<p style="font-weight: bold;font-size: 14pt;">ที่อยู่ออกใบเสร็จ <span style="font-weight: normal;font-size: 14pt;"><?php echo $order['member_same'];?></span></p>
				</div>
			</div>
		</div>
	</div>
	<table class="items" width="100%" style="font-size: 10pt; border-collapse: collapse; " cellpadding="8">
		<thead>
			<tr>
				<td  style="font-weight: bold;font-size: 12pt;">ลำดับ</td>
				<td  style="font-weight: bold;font-size: 12pt;">รหัสสินค้า</td>
				<td  style="font-weight: bold;font-size: 12pt;">รายการ</td>
				<td  style="font-weight: bold;font-size: 12pt;">ราคา/หน่วย</td>
				<td  style="font-weight: bold;font-size: 12pt;">จํานวน</td>
				<td  style="font-weight: bold;font-size: 12pt;">รวมราคา</td>
			</tr>
		</thead>
		<?php $i =1 ?>
		<?php
			foreach ($order_product as $key => $value) { ?>
                        <tbody>
                            <tr>
                                <td style="text-align: center; vertical-align: middle;"><?php echo $i++ ?></td>
                                <td style="text-align: center; vertical-align: middle;"><?php echo $value['product_code']?></td>
                                <td style="text-align: left; vertical-align: middle;"><?php echo $value['product_name']?></td>
                                <td style="text-align: right; vertical-align: middle;"><?php echo number_format($value['price'], 2)?></td>
                                <td style="text-align: right; vertical-align: middle;"><?php echo $value['quantity']?></td>
                                <td style="text-align: right; vertical-align: middle;"><?php echo number_format($value['sub_total'], 2)?></td>
                            </tr>
                        </tbody>

                    <?php } ?>
		<tbody>
			<!-- END ITEMS HERE -->
			<tr>
				<td class="blanktotal" colspan="4" rowspan="2"></td>
				<td class="totals">ค่าจัดส่ง:</td>
				<td class="totals cost">0 บาท</td>
			</tr>
			<tr>
				<td class="totals" style="font-weight: bold;"><b>รวมทั้งหมด:</b></td>
				<td class="totals cost"><b><?php echo number_format($order['grand_total'],2);?> บาท</b></td>
			</tr>
		</tbody>
	</table>
	<div class="footer">
		<p>ถ้าท่านมีข้อสงสัยเพิ่มเติม กรุณาติดต่อศูนย์บริการลูกค้าทาง yeejub20online@gmail.com หรือโทร 088-025-8888</p>
	</div>
</body>

</html>