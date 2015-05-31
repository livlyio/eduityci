
<div class="center-block" style="text-align:left;">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="panel panel-primary">
                    <div class="panel-heading">
                         <h2 class="panel-title" style="display: inline;">%LID%</h2>

                        <div class="" style="float:right; paddding-right: 30px;">%TITLE%</div>
                    </div>
                    <div class="panel-body">
                        <div class="row">
                            <div class="col-md-4">
                                <div class="container">
                                    <div class="row">%NAME%</div>
                                    <div class="row">%ADDRESS%</div>
                                    <div class="row">%ADDRESS2%</div>
                                    <div class="row">%CITY% %STATE%, %ZIP%</div>
                                </div>	
                            </div>
                            <div class="col-md-4">
                                <div class="container">
                                    <div class="row">%PAYMENT_METHOD%</div>
                                    <div class="row">Fraud Score %MAXMIND_SCORE%</div>
                                    <div class="row">
                                        <button type="button" class="btn btn-default btn-xs" onclick="window.location.href='%VIEWLINK%';" title="Edit Customer">
                                            <span class="glyphicon glyphicon-search" contenteditable="false"></span>
                                            Edit
                                        </button>
                                        <button type="button" class="btn btn-default btn-xs" onclick="window.location.href='%VIEWLINK%';" title="View/Pay Balance">
                                            <span class="glyphicon glyphicon-shopping-cart" contenteditable="false"></span>
                                            Balance
                                        </button>
                                        <button type="button" class="btn btn-default btn-xs" onclick="window.location.href='%VIEWLINK%';" title="History Log">
                                            <span class="glyphicon glyphicon-dashboard" contenteditable="false"></span>
                                            History
                                        </button>                                      
                                    </div>
                                    <div class="row">
                                        <button type="button" class="btn btn-default btn-xs" onclick="window.location.href='%VIEWLINK%';" title="PrePay/Credits">
                                            <span class="glyphicon glyphicon-usd" contenteditable="false"></span>
                                            PrePays
                                        </button>
                                        <button type="button" class="btn btn-default btn-xs" onclick="window.location.href='%VIEWLINK%';" title="Adjust Billing Dates">
                                            <span class="glyphicon glyphicon-calendar" contenteditable="false"></span>
                                            Billing Dates
                                        </button>
                                      
                                      
                                  	</div>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="container">
                                    <div class="row">#%ID%
                                        <button type="button" class="btn btn-default btn-xs" onclick="window.location.href='%SUDOLINK%';" title="Login to the client interface">
                                          <span class="glyphicon glyphicon-log-in"></span> 
                                          Sudo
                                        </button>
                                    </div>
                                    <div class="row">
	                                   	%STATUS%
										<button type="button" class="btn btn-default btn-xs" onclick="window.location.href='%VIEWLINK%';" title="Disable Account">
                                            <span class="glyphicon glyphicon-thumbs-down" contenteditable="false"></span>
                                            Disable
                                        </button>                                      
                                    </div>
                                    <div class="row">%COMPANY%</div>
                                    <div class="row">%PHONE%</div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="center-block" style="text-align:left;">
	<div class="container">
		<div class="row">
			<div class="col-md-12">
				<div class="panel panel-primary">
					<div class="panel-heading">
						<h2 class="panel-title" style="display: inline;">%SERVERNAME%</h2>
						<div class="" style="float:right; paddding-right: 30px;">Dedicated Server</div>
					</div>
					<div class="panel-body">
						<div class="row">
							<div class="col-md-4">
								<button type="button" class="btn btn-default btn-xs" onclick="window.location.href='%VIEWLINK%';" title="View and Manage %TITLE%">
									<span class="glyphicon glyphicon-search"></span> Details
								</button>
								Order <span class="badge">#%ID%</span>
							</div>
							<div class="col-md-3 text-center">
								Status %STATUS%
							</div>
							<div class="col-md-5 text-right">
								%LID%
								<button type="button" class="btn btn-default btn-xs" onclick="window.location.href='%SUDOLINK%';" title="Login to the client interface">
									<span class="glyphicon glyphicon-log-in"></span> Sudo
								</button>
							</div>
						</div>
						<div class="row">
							<div class="col-md-4">
								%HARDWARE%
							</div>
							<div class="col-md-3">
								<ul class="list-group">
									<li class="list-group-item"><span class="glyphicon glyphicon-unchecked"></span> Pending Setup</li>
									<li class="list-group-item"><span class="glyphicon glyphicon-check"></span> Hardware Ordered</li>
									<li class="list-group-item"><span class="glyphicon glyphicon-unchecked"></span> IPs Assigned</li>
									<li class="list-group-item"><span class="glyphicon glyphicon-check"></span> Welcome Email</li>
								</ul>
							</div>
							<div class="col-md-5">
								<table class="table table-condensed">
									<thead>
										<tr>
											<th>VLAN</th>
											<th>%VLAN%</th>
										</tr>
									</thead>
									<tbody>
										<tr>
											<td>IP Address:</td>
											<td>%IP%</td>
										</tr>
										<tr>
											<td>Netmask:</td>
											<td>%NETMASK</td>
										</tr>
										<tr>
											<td>Last Usable IP</td>
											<td>%LAST_USABLE%</td>
										</tr>
										<tr>
											<td>Switch / Port</td>
											<td>%SWITCH%/%PORT%</td>
										</tr>
									</tbody>
								</table>
							</div>
						</div>
						<div class="row">
							<div class="col-md-6">
								Server ID # %SERVERID%<br>
								Location
								 <span class="badge" title="datacenter">%LOCATION_DATACENTER%</span>
								 <span class="badge" title="rack">%LOCATION_RACK%</span>
								 <span class="badge" title="row">%LOCATION_ROW%</span>
								 <span class="badge" title="col">%LOCATION_COL%</span>
								 <span class="badge" title="unit_start">%LOCATION_UNIT_START%</span>
								 <span class="badge" title="unit_end">%LOCATION_UNIT_END%</span>
								 <span class="badge" title="unit_sub">%LOCATION_UNIT_SUB%</span>
								<button type="button" class="btn btn-default btn-xs" onclick="window.location.href='%BWLINK%';" title="Bandwidth Graphs">
									<span class="glyphicon glyphicon-search"></span> Bandwidth Graphs
								</button>
							</div>
							<div class="col-md-6 text-right">
								Last Invoiced %LASTINVDATE%<br>
								Last Invoie Paid %LASTINVPAID%<br>
								Next Invoice %NEXTINVDATE%
							</div>
						</div>

					</div>
				</div>
			</div>
		</div>
	</div>
</div>

<div class="center-block" style="text-align:left;">
	<div class="container">
		<div class="row">
			<div class="col-md-12">
				<div class="panel panel-primary">
					<div class="panel-heading">
						<h2 class="panel-title" style="display: inline;">%IP%</h2>
						<div class="" style="float:right; paddding-right: 30px;">IP Address</div>
					</div>
					<div class="panel-body">
						<div class="row">
							<div class="col-md-6">VLAN %VLAN%</div>
							<div class="col-md-6">
								%SERVERNAME%
								<button type="button" class="btn btn-default btn-xs" onclick="window.location.href='%VIEWLINK%';" title="View Order">
									<span class="glyphicon glyphicon-log-in"></span> View Order
								</button>
							</div>
						</div>
						<div class="row">
							<div class="col-md-6">Switch %SWITCH%</div>
							<div class="col-md-6">Port %PORT%
								<button type="button" class="btn btn-default btn-xs" onclick="window.location.href='%BWLINK%';" title="View Bandwidth Usage">
									<span class="glyphicon glyphicon-search"></span> View Bandwidth Usage
								</button>
							</div>
						</div>

					</div>
				</div>
			</div>
		</div>
	</div>
</div>

<div class="center-block" style="text-align:left;">
	<div class="container">
		<div class="row">
			<div class="col-md-12">
				<div class="panel panel-primary">
					<div class="panel-heading">
						<h2 class="panel-title" style="display: inline;">%TITLE_FIELD%</h2>
						<small>#%ID%</small>
						%STATUS%
						<div class="" style="float:right; paddding-right: 30px;">%TITLE%</div>
					</div>
					<div class="panel-body">
						<div class="row">
							<div class="col-md-6">%TITLE_FIELD2%  %OPENSPOT%</div>
							<div class="col-md-6">
								%LID%
								<button type="button" class="btn btn-default btn-xs" onclick="window.location.href='%SUDOLINK%';" title="Login to the client interface">
									<span class="glyphicon glyphicon-log-in"></span> Sudo
								</button>
							</div>
						</div>
						<div class="row">
							<div class="col-md-6">Last Invoice %LASTINVDATE% %LASTINVPAID%</div>
							<div class="col-md-6">
								Next Invoice %NEXTINVDATE%
								<button type="button" class="btn btn-default btn-xs" onclick="window.location.href='%VIEWLINK%';" title="View and Manage %TITLE%">
									<span class="glyphicon glyphicon-search"></span> View
								</button>

							</div>
						</div>

					</div>
				</div>
			</div>
		</div>
	</div>
</div>
