<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title></title>
	<link href="https://fonts.googleapis.com/css2?family=Barlow:wght@400;500;600;700;800&family=Nunito+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet">
</head>
<body style="margin: 0;">

	<div class="mail-template" style="max-width: 100%; margin: 0 auto;">
		<table cellpadding="0" cellspacing="0" width="100%">
			<thead>
				<tr style="height:0px; width:100%; background-size:cover;background-repeat:no-repeat;">
					<th style="text-align: center; font-size:20px; color:#007bff">Forgot Your Password?</th>
				</tr>
			</thead>
			<tbody>
				<tr>
					<td style="">
                        @yield('email-content') 
					</td>
				</tr>
			</tbody>
			<tfoot>
				<tr>
					<td>
						<p class="copyright" style="margin: 0; background-color: #007bff; padding:22px 0; text-align:center; font-size: 16px; font-weight: 400; font-family: 'Nunito Sans', sans-serif; color:#fff;">© {{ date('Y') }} All Copyrights Reserved By {{config('app.name')}}</p>
					</td>
				</tr>
			</tfoot>
		</table>
	</div>
	
</body>
</html>