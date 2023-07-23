<!DOCTYPE html>
<html lang="en">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
    <meta name="viewport" content="width=device-width; initial-scale=1.0; maximum-scale=1.0;" />
</head>
<body>
	<center>
		<div style="width:100%;background:#F7F6FA;padding:10px; margin: 0;">
        	<div style="width:650px;margin:0 auto;background:#ffffff;">
        		<table border="0" cellpadding="0" cellspacing="0" style="font-family:Arial,sans serif;width: 600px; font-size: 12px;line-height: 22px;">
        		    <tbody>
        		        <tr>
        		            <td>
        		                <table border="0" cellpadding="8" cellspacing="0" style="width: 100%;">
        		                    <tbody>        		                        
        		                        <tr>
        		                            <td colspan="2">
        		                                <label>Hello  {{ $user['name'] }} ,</label>
        		                            </td>
        		                        </tr>
        		                        <tr>
        		                            <td colspan="2"></td>
        		                        </tr>
        		                        <tr>
        		                            <td colspan="2">
        		                                <p>{{ $user['message'] }}</p>
        		                            </td>
        		                        </tr>
        		                        <tr>
        		                            <td colspan="2"></td>
        		                        </tr>
        		                    </tbody>
        		                </table>
        		            </td>
        		        </tr>
        		        <tr>
        		            <td>
        		                <table border="1" cellpadding="8" cellspacing="0" style="width: 100%;">
        		                    <thead>
        		                        <th style="font-weight: bold;">To Email</th>
        		                        <th style="font-weight: bold;">From Email</th>
        		                        <th style="font-weight: bold;">Date</th>
	                                    <th style="font-weight: bold;">Start Time</th>
	                                    <th style="font-weight: bold;">Candidate Name</th>
	                                    <th style="font-weight: bold;">Meeting URL</th>
	                                    <th style="font-weight: bold;">End Time</th>
        		                    </thead>
        		                    <tbody>
        		                    	<tr>
        		                    	    <td><label>{{ $user['to_email'] }}</label></td>
        		                    	    <td><label>{{ $user['frm_email'] }}</label></td>
        		                    	    <td><label>{{ $user['st_date'] }}</label></td>
        		                    	    <td><label>{{ date('h:i a', strtotime($user['st_time'])) }}</label></td>
        		                    	    <td><label>{{ $user['user_name'] }}</label></td>
        		                    	    <td><label>{{ $user['meating_url'] }}</label></td>
        		                    	    <td><label>{{ date('h:i a', strtotime($user['ed_time'])) }}</label></td>
        		                    	</tr>
        		                    </tbody>
        		                </table>
        		            </td>
        		        </tr>
        		        <tr>
        		            <td colspan="2"><label>&nbsp;</label></td>
        		        </tr>
        		        <tr>
        		            <td colspan="2"><label>&nbsp;</label></td>
        		        </tr>
        		        <tr>
        		            <td>
        		                <table border="0" cellpadding="8" cellspacing="0" style="width: 100%;">
        		                    <tbody>
        		                        <tr>
        		                            <td>
        		                                We look forward to hearing from you.
        		                            </td>
        		                        </tr>
        		                        <tr>
        		                            <td>
        		                                Thanks
        		                            </td>
        		                        </tr>
        		                        <tr>
        		                            <td>
        		                                Best Regards,
        		                            </td>
        		                        </tr>
        		                        <tr>
        		                            <td>
        		                                Jayesh
        		                            </td>
        		                        </tr>
        		                    </tbody>
        		                </table>
        		            </td>
        		        </tr>
        		    </tbody>
        		</table>
        	</div>
        </div>
	</center>
</body>
</html>