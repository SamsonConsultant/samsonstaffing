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
        		                        <tr>
        		                            <th style="font-weight: bold;">Sl No.</th>
        		                            @if(in_array('Employee Name', $user['mail_format']))
        		                            	<th style="font-weight: bold;">Employee Name</th>
        		                            @endif
        		                            @if(in_array('Employee Phone', $user['mail_format']))
        		                            	<th style="font-weight: bold;">Employee Phone</th>
        		                            @endif
        		                            @if(in_array('Employee Email', $user['mail_format']))
        		                            	<th style="font-weight: bold;">Employee Email</th>
        		                            @endif
        		                            @if(in_array('Gender', $user['mail_format']))
        		                            	<th style="font-weight: bold;">Gender</th>
        		                            @endif
        		                            @if(in_array('Position For', $user['mail_format']))
        		                            	<th style="font-weight: bold;">Position For</th>
        		                            @endif
        		                            @if(in_array('Qualification', $user['mail_format']))
        		                            	<th style="font-weight: bold;">Qualification</th>
        		                            @endif
        		                            @if(in_array('Experience in Year', $user['mail_format']))
        		                            	<th style="font-weight: bold;">Experience in Year</th>
        		                            @endif
        		                            @if(in_array('Attached CV', $user['mail_format']))
        		                            	<th style="font-weight: bold;">Attached CV</th>
        		                            @endif
        		                        </tr>
        		                    </thead>
        		                    <tbody>
        		                    	@forelse($user['all_job'] as $k => $job)
	        		                        <tr>
	        		                            <td><label>{{ $k+1 }}</label></td>
	        		                            @if(in_array('Employee Name', $user['mail_format']))
	        		                            	<td><label>{{ $job->user->name ?? '' }}</label></td>
	        		                            @endif
	        		                            @if(in_array('Employee Phone', $user['mail_format']))
	        		                            	<td><label>{{ $job->user->contact_number ?? '' }}</label></td>
	        		                            @endif
	        		                            @if(in_array('Employee Email', $user['mail_format']))
	        		                            	<td><label>{{ $job->user->email ?? '' }}</label></td>
	        		                            @endif
	        		                            @if(in_array('Gender', $user['mail_format']))
	        		                            	<td><label>{{ $job->user->gender ?? '' }}</label></td>
	        		                            @endif
	        		                            @if(in_array('Position For', $user['mail_format']))
	        		                            	<td><label>{{ $job->job->title ?? '' }}</label></td>
	        		                            @endif
	        		                            @if(in_array('Qualification', $user['mail_format']))
	        		                            	<td><label>{{ $job->user->education_list ?? '' }}</label></td>
	        		                            @endif
	        		                            @if(in_array('Experience in Year', $user['mail_format']))
	        		                            	<td><label>{{ getUserExperince($job->user_id) }}</label></td>
	        		                            @endif
	        		                            @if(in_array('Attached CV', $user['mail_format']))
	        		                            	<td><label><a href="{{ asset('public') }}/{{ $job->cv_path }}" target="_blank" download>View</a></label></td>
	        		                            @endif
	        		                        </tr>
	        		                    @empty
	        		                    	<tr>
	        		                    		<td colspan="4"></td>
	        		                    	</tr>
	        		                    @endforelse        		                         
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