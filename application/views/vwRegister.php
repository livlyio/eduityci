<style type="text/css">
  ul { list-style: none; margin: 0; padding: 0; }
  li { margin: .2em 0; }
  
  .info_req label { 
    float: left; 
    width: 200px; 
    margin-right: 15px; 
    text-align: right; 
  }
  fieldset {
    margin-top:40px;
    
  }
  </style>

<div id="container" class="ltr">

	
	<!-- Main Content -->
	<div class="content_wrap main_content_bg">
		<div class="content clearfix">
			<div class="col100">

			<?php if (! empty($message)) { ?>
				<div id="message">
					<?php echo $message; ?>
				</div>
			<?php } ?>
				
				<?php echo form_open(current_url() . '/register_account'); ?>  	
					<fieldset>
						<legend>Personal Details</legend>
						<ul>
							<li class="info_req">
								<label for="first_name">First Name:</label>
								<input type="text" id="first_name" name="register_first_name" value="<?php echo set_value('register_first_name');?>"/>
							</li>
							<li class="info_req">
								<label for="last_name">Last Name:</label>
								<input type="text" id="last_name" name="register_last_name" value="<?php echo set_value('register_last_name');?>"/>
							</li>
							<li class="info_req">
								<label for="phone_number">Phone Number:</label>
								<input type="text" id="phone_number" name="register_phone_number" value="<?php echo set_value('register_phone_number');?>"/>
							</li>

						</ul>
					</fieldset>
					
					<fieldset>
						<legend>Login Details</legend>
						<ul>
							<li class="info_req">
								<label for="email_address">Email Address:</label>
								<input type="text" id="email_address" name="register_email_address" value="<?php echo set_value('register_email_address');?>" class="tooltip_trigger"
									title="This demo requires that upon registration, you will need to activate your account via clicking a link that is sent to your email address."
								/>
							</li>
							<li class="info_req">
								<label for="username">Username:</label>
								<input type="text" id="username" name="register_username" value="<?php echo set_value('register_username');?>" class="tooltip_trigger"
									title="Set a username that can be used to login with."
								/>
							</li>
							<li class="info_req">
								<label for="password">Password:</label>
								<input type="password" id="password" name="register_password" value="<?php echo set_value('register_password');?>"/>
							</li>
							<li class="info_req">
								<label for="confirm_password">Confirm Password:</label>
								<input type="password" id="confirm_password" name="register_confirm_password" value="<?php echo set_value('register_confirm_password');?>"/>
							</li>
						</ul>
					</fieldset>
					
					<fieldset>
								<h6>Terms of Service</h6>
							<div style="overflow:auto;height:200px;width:600px;"> 
                            
<p align="CENTER">
	<strong>EDUITY TERMS OF SERVICE</strong>
</p>
<p>
	PLEASE READ THESE TERMS OF SERVICE CAREFULLY. BY CLICKING "ACCEPTED AND AGREED," EACH CUSTOMER AGREES TO THESE TERMS OF SERVICE.
</p>
<p>
	These Terms of Service constitute an agreement (this "Agreement") by and between Eduity, LLC, a Tennessee limited liability company ("Eduity") and you,
	Eduity's customer ("Customer").
</p>

		<p>
			<u><strong>Service &amp; Payment.</strong></u>
		</p>

				<p>
					<em>Service</em>
					. Eduity provides the services available through the Eduity website and interface ("the Service") to Customer solely pursuant to this
					Agreement, and all Exhibits hereto.
				</p>

				<p>
					<em>Accounts</em>
					. Eduity Customers may create an account through the Eduity interface, and select among the following levels of the Service:
				</p>

						<p>
							<em>Free</em>
							: Capability Mapping. Any person or organization may create a free user account in order to access and create an Eduity capability
							map.
						</p>

						<p>
							<em>Basic</em>
							: Customers upgrading to the Basic level of services will have the ability to share their capability maps and plans with others,
							collaborate, create groups, view supply and demand information, and purchase, award, and receive talent tokens.
						</p>

						<p>
							<em>Premium</em>
							: Customers upgrading to Premium level services will have the ability to integrate individual capability maps and plans into their
							organizational capability map, combine and aggregate organizational maps, and analyze those data with individual plans within
							Eduity.
						</p>

				<p>
					<em>Payment</em>
					. Customer will pay Eduity such monthly Service fees as are required for Customer's Account, due on the day before the start of the
					calendar month of Service.
				</p>

		<p>
			<u><strong>Data Management.</strong></u>
		</p>

				<p>
					Eduity Customer's input personal, professional, and organizational information as they build capability maps, and perform other functions
					of the Service ("Customer Data"). Customer grants to Eduity a worldwide, non-exclusive, royalty-free, sublicenseable and transferable
					license to use, reproduce, distribute, prepare derivative works of, and display the Data in connection with the Service and Eduity's (and
					its successors' and affiliates') business, including without limitation for promoting and redistributing part or all of the Service and
					derivative works thereof.
				</p>

				<p>
					Unless the Customer chooses to share, make available, or make public specific or identifying information about Customer, all Customer Data
					accessible to third parties will be in an aggregated and anonymous form only.
				</p>

				<p>
					Unless it receives Customer's prior written consent, Eduity and its employees: (i) will not access or use Customer Data other than as
					necessary to facilitate the Service; and (ii) will not give any third party access to Customer Data, except as described in subsection 2(b)
					above. Notwithstanding the foregoing, Eduity may disclose Customer Data as required by applicable law or by proper legal or governmental
					authority. Eduity will give Customer prompt notice of any such legal or governmental demand and reasonably cooperate with Customer in any
					effort to seek a protective order or otherwise to contest such required disclosure, at Customer's expense.
				</p>

				<p>
					<em>Customer's Rights</em>
					. Customer retains ownership in and to Customer Data, subject to Eduity's use and possession pursuant to the license above. Customer may
					access and copy any Project Data in Eduity's possession at any time, through the Eduity interface.
				</p>

				<p>
					<em>Retention</em>
					. Pursuant to the license above, Eduity reserves the right to retain all Customer Data.
				</p>

				<p>
					<em>Technical &amp; Physical Security</em>
					. In its handling of Project Data, Eduity will observe and implement industry standard data security protections and protocols.
				</p>

				<p>
					<em>Compliance with Law &amp; Policy</em>
					. Eduity will comply with all applicable federal and state laws and regulations governing the handling of Project Data.
				</p>

		<p>
			<u><strong>Service Availability.</strong></u>
			Eduity's goal is to achieve 100% availability of the Service for all Customers. Eduity will from time to time have to perform planned maintenance
			and upgrades to the Service, which will result in occasional brief unavailability of the Service. Eduity will provide reasonable notice to
			customers in advance of a planned Service unavailability, and will endeavor to perform such planned maintenance outside of normal business hours.
			Eduity will also make every effort to recover and re-establish the Service after any unplanned or emergency event which causes the Service to
			become unavailable.
		</p>

		<p>
			<u><strong>Software &amp; Intellectual Property (IP).</strong></u>
		</p>

				<p>
					<em>Interface elements</em>
					. Customer recognizes and agrees that: (i) the written and graphical content provided by or through the Service, including, without
					limitation, text, photographs, illustrations, and designs, whether provided by Eduity, another customer of the Service, or any other third
					party are the property of Eduity or its licensors and are protected by copyright, trademark, and other intellectual property laws; and (ii)
					Customer does not acquire any right, title, or interest in said material except the limited and temporary right to use them as necessary
					for Customer's use of the Service.
				</p>

				<p>
					<em>IP in General</em>
					. Eduity retains all right, title, and interest in and to the Service, including without limitation all software used to provide the
					Service and all logos and trademarks reproduced through the Service, and this Agreement does not grant Customer any intellectual property
					rights in or to the Service or any of its components.
				</p>

		<p>
			<u><strong>Online Policies.</strong></u>
		</p>

				<p>
					<em>Acceptable Use Policy</em>
					. Customer will to comply with the Acceptable Use Policy ("AUP") attached as Exhibit A. In the event of Customer's material breach of the
					AUP, including without limitation any copyright infringement, Eduity may suspend or terminate Customer's access to the Service, in addition
					to such other remedies as Eduity may have at law or pursuant to this Agreement. Neither this Agreement nor the AUP requires that Eduity
					take any action against Customer or any other customer for violating the AUP, but Eduity is free to take any such action it sees fit.
				</p>

				<p>
					<em>Privacy Policy</em>
					. The Privacy Policy applies only to the Service and does not apply to any third party site or service linked to the Service or recommended
					or referred to through the Service or by Eduity's employees.
				</p>

		<p>
			<u><strong>Disclaimer and Limitation of Liability.</strong></u>
			<strong> </strong>
		</p>

				<p>
					THE SERVICE IS PROVIDED "AS IS" AND AS AVAILABLE, AND EDUITY MAKES NO WARRANTIES, EITHER EXPRESS OR IMPLIED, INCLUDING WITHOUT LIMITATION
					ANY IMPLIED WARRANTIES OF MERCHANTABILITY, FITNESS FOR A PARTICULAR PURPOSE, OR NONINFRINGEMENT OF INTELLECTUAL PROPERTY RIGHTS. Without
					limiting the generality of the foregoing, (i) EDUITY HAS NO OBLIGATION TO INDEMNIFY OR DEFEND CUSTOMER AGAINST CLAIMS RELATED TO
					INFRINGEMENT OF INTELLECTUAL PROPERTY RIGHTS; and (ii) Eduity does not warrant that the Service will perform without error or immaterial
					interruption.
				</p>

				<p>
					IN NO EVENT: (a) WILL EDUITY'S LIABILITY ARISING OUT OF OR RELATED TO THIS AGREEMENT EXCEED A SINGLE MONTH'S SERVICE FEE CHARGED UNDER THIS
					AGREEMENT; AND (b) WILL EDUITY BE LIABLE FOR ANY CONSEQUENTIAL, INDIRECT, SPECIAL, INCIDENTAL, OR PUNITIVE DAMAGES. THE LIABILITIES LIMITED
					BY THIS SECTION 6 APPLY: (i) TO LIABILITY FOR NEGLIGENCE; (ii) REGARDLESS OF THE FORM OF ACTION, WHETHER IN CONTRACT, TORT, STRICT PRODUCT
					LIABILITY, OR OTHERWISE; (iii) EVEN IF EDUITY IS ADVISED IN ADVANCE OF THE POSSIBILITY OF THE DAMAGES IN QUESTION AND EVEN IF SUCH DAMAGES
					WERE FORESEEABLE; AND (iv) EVEN IF CUSTOMER'S REMEDIES FAIL OF THEIR ESSENTIAL PURPOSE. If applicable law limits the application of the
					provisions of this Section 7, Eduity's liability will be limited to the maximum extent permissible.
				</p>

		<p>
			<u><strong>Term &amp; Termination.</strong></u>
		</p>

				<p>
					<em>Term</em>
					. This Agreement will continue month to month following the Effective Date unless either party notifies the other of its intent not to
					renew 15 or more days before the beginning of the next month.
				</p>
				<p>
					<em>Effects of Termination</em>
					. The following provisions will survive termination of this Agreement: (i) any obligation of Customer to pay for Service rendered before
					termination; (ii) Sections 2, 4, 5 and 6 of this Agreement; and (iii) any other provision of this Agreement that must survive termination
					to fulfill its essential purpose.
				</p>

		<p>
			<u><strong>Miscellaneous.</strong></u>
		</p>

				<p>
					<em>Notices</em>
					. Eduity may send notices pursuant to this Agreement to Customer's contact points listed in Customer's Account. Customer may send notices
					pursuant to this Agreement to info@eduity.net.
				</p>

				<p>
					<em>Amendment</em>
					. Eduity may amend this Agreement (including the Exhibits) from time to time by posting an amended version at its website and sending
					Customer written notice thereof. Such amendment will be deemed accepted and become effective 30 days after such notice.
				</p>

				<p>
					<em>No Waiver</em>
					. Neither party will be deemed to have waived any of its rights under this Agreement by lapse of time or by any statement or representation
					other than in an explicit written waiver. No waiver of a breach of this Agreement will constitute a waiver of any prior or subsequent
					breach of this Agreement.
				</p>

				<p>
					<em>Force Majeure</em>
					. To the extent caused by force majeure, no delay, failure, or default will constitute a breach of this Agreement.
				</p>

				<p>
					<em>Assignment &amp; Successors</em>
					. Neither party may assign this Agreement or any of its rights or obligations hereunder without the other's express written consent.
				</p>

				<p>
					<em>Choice of Law &amp; Jurisdiction</em>
					. This Agreement will be governed solely by the internal laws of the State of Tennessee, without reference to such State's principles of
					conflicts of law. The parties consent to the personal and exclusive jurisdiction of the federal and state courts of Hamilton County,
					Tennessee.
				</p>

				<p>
					<em>Severability</em>
					. To the extent permitted by applicable law, the parties hereby waive any provision of law that would render any clause of this Agreement
					invalid or otherwise unenforceable in any respect. In the event that a provision of this Agreement is held to be invalid or otherwise
					unenforceable, such provision will be interpreted to fulfill its intended purpose to the maximum extent permitted by applicable law, and
					the remaining provisions of this Agreement will continue in full force and effect.
				</p>

				<p>
					<em>Conflicts among Attachments</em>
					. In the event of any conflict between the terms of this main body of this Agreement and those of the SLA, the terms of this main body will
					govern. In the event of any conflict between this Agreement and any Eduity policy posted online, including without limitation the AUP and
					Privacy Policy, the terms of this Agreement will govern.
				</p>

				<p>
					<em>Entire Agreement</em>
					. This Agreement sets forth the entire agreement of the parties and supersedes all prior or contemporaneous writings.
				</p>
<p align="CENTER">
	<strong>EXHIBIT A: ACCEPTABLE USE POLICY</strong>
</p>
<p>
	<u>A. Unacceptable Use</u>
</p>
<p>
	Eduity requires that all customers and other users of Eduity's Service conduct themselves with respect for others. In particular, please observe the
	following rules in your use of the Service:
</p>

		<p>
			<em>Abusive Behavior:</em>
			Do not harass, threaten, or defame any person or entity. Do not contact any person who has requested no further contact. Do not use ethnic or
			religious slurs against any person or group.
		</p>

		<p>
			<em>Privacy:</em>
			Do not violate the privacy rights of any person. Do not collect or disclose any personal address, social security number, or other personally
			identifiable information without each holder's written permission. Do not cooperate in or facilitate identity theft.
		</p>

		<p>
			<em>Intellectual Property:</em>
			Do not infringe upon the copyrights, trademark rights, trade secret rights, or other intellectual property rights of any person or entity. Do not
			reproduce, publish, or disseminate software, audio recordings, video recordings, photographs, articles, or other works of authorship without the
			written permission of the copyright holder.
		</p>

		<p>
			<em>Hacking, Viruses, &amp; Network Attacks:</em>
			Do not access any other person's or organization's account without authorization, including the computers used to provide the Service. Do not
			attempt to penetrate or disable any security system. Do not intentionally distribute a computer virus, launch a denial of service attack, or in any
			other way attempt to interfere with the functioning of the Service. Do not attempt to access or otherwise interfere with the accounts of other
			users of the Service.
		</p>

		<p>
			<em>Spam:</em>
			Do not send bulk unsolicited e-mails ("Spam") or sell or market any product or service advertised by or connected with Spam. Do not facilitate or
			cooperate in the dissemination of Spam in any way. Do not violate the CAN-Spam Act of 2003.
		</p>

		<p>
			<em>Fraud:</em>
			Do not post any misleading or fraudulent information to the Service. Do not mislead anyone about the details or nature of your participation in the
			Service. Do not commit fraud in any other way.
		</p>

		<p>
			<em>Violations of Law:</em>
			Do not violate any law in conjunction with your use of the Service.
		</p>

<p>
	<u>B. Consequences of Violation</u>
</p>
<p>
	Violation of this Acceptable Use Policy (this "AUP") may lead to suspension or termination of the user's account or legal action. In addition, the user may
	be required to pay for the costs of investigation and remedial action related to AUP violations. Eduity reserves the right to take any other remedial
	action it sees fit.
</p>
<p>
	<u>C. Reporting Unacceptable Use</u>
</p>
<p>
	Eduity requests that anyone with information about a violation of this AUP report it via an e-mail to the following address: info@eduity.net. Please
	provide the date and time (with time zone) of the violation and any identifying information regarding the violator, including e-mail or IP (internet
	protocol) address if available, as well as details of the violation.
</p>
<p>
	<u>D. Revision of AUP</u>
</p>
<p>
	Eduity may change this AUP at any time by posting a new version on this page and sending the user written notice thereof. The new version will become
	effective on the date of such notice.
</p>
<p align="CENTER">
	<strong>EXHIBIT B: PRIVACY POLICY</strong>
</p>
<p>
	The purpose of Eduity involves collecting information and data from Customers for transformative analysis, planning, comparison, verification, and use.
	This page (this "Privacy Policy") lays out our policies and procedures surrounding the collection and handling of any such information that identifies a
	user or that could be used to contact or locate him or her, or it ("Personally Identifiable Information" or "PII").
</p>
<p>
	This Privacy Policy applies only to Eduity. It does not apply to any third party site or service linked to our Website or recommended or referred by our
	Website or by our staff. And it does not apply to any other website or online service operated by our company, or to any of our offline activities.
</p>
<p>
	<u>A. PII We Collect</u>
</p>
<p>
	All of the information collected by Eduity is potentially PII. We also use "cookies" to collect certain information from all users, including website
	visitors who don't buy anything through our Website. A cookie is a string of data our system sends to your computer and then uses to identify your computer
	when you return to our Website. Cookies give us usage data, like how often you visit, where you go at the site, and what you do.
</p>
<p>
	<u>B. Our Use of PII</u>
</p>
<p>
	Eduity is a social platform for people to guide and support each other's development to meet employers' demands for capabilities. Eduity uses the
	information collected from the Customer for the purposes of providing the analytical tools to for employers get just the capabilities they need at the
	right place &amp; time, and for individual to get fulfilling, high-paying work. With Eduity everyone succeeds by helping others succeed. All data collected
	by Eduity from Free Accounts will be aggregated and anonymized to prevent any unauthorized user from accessing the same. We use your Personally
	Identifiable Information to create your account, to communicate with you about products and services you've purchased, to offer you additional products and
	services, and to bill you. We also use that information to the extent necessary to enforce our Website terms of service and to prevent imminent harm to
	persons or property.
</p>
<p>
	We use cookies so that our Website can remember you and provide you with the information you're most likely to need. For instance, when you return to our
	Website, cookies identify you and prompt the site to provide your username (not your password), so you can sign in more quickly. Cookies also allow our
	Website to remind you of your past purchases and to suggest similar products and services. Finally, we use information gained through cookies to compile
	statistical information about use of our Website, such as the time users spend at the site and the pages they visit most often. Those statistics do not
	include PII.
</p>
<p>
	<u>C. Protection of PII</u>
</p>
<p>
	Eduity will employ best practice industry standard data security tools to protect Personally Identifiable Information. Unfortunately, even with these
	measures, we cannot guarantee the security of PII. By using our Website, you acknowledge and agree that we make no such guarantee, and that you use our
	Website at your own risk.
</p>
<p>
	<u>D. Contractor and Other Third Party Access to PII</u>
</p>
<p>
	We give certain independent contractors access to Personally Identifiable Information. Those contractors assist us with developing and maintaining our
	software and the website and portal. All those contractors are required to sign contracts in which they promise to protect PII using procedures reasonably
	equivalent to ours. (Users are not third party beneficiaries of those contracts.) We also may disclose PII to attorneys, collection agencies, or law
	enforcement authorities to address potential AUP violations, other contract violations, or illegal behavior. And we disclose any information demanded in a
	court order or otherwise required by law or to prevent imminent harm to persons or property.
</p>
<p>
	As noted above, we compile Website usage statistics from data collected through cookies. We may publish those statistics or share them with third parties,
	but they don't include PII.
</p>
<p>
	<u>E. Accessing and Correcting Your PII</u>
</p>
<p>
	You can access and change any Personally Identifiable Information we store through your "My Account" page.
</p>
<p>
	<u>F. Leaks</u>
</p>
<p>
	Eduity will promptly notify Customer of any actual or potential exposure or misappropriation of PII (any "Leak") that comes to Eduity's attention. Eduity
	will cooperate with Customer and with law enforcement authorities in investigating any such Leak, at Eduity's expense. Eduity will likewise cooperate with
	Customer and with law enforcement agencies in any effort to notify injured or potentially injured parties, and such cooperation will be at Eduity's
	expense, except to the extent that the Leak was caused by Customer. The remedies and obligations set forth in this Subsection are in addition to any others
	Customer may have.
</p>
<p>
	<u>G. Amendment of this Privacy Policy</u>
</p>
<p>
	We may change this Privacy Policy at any time by posting a new version on this page or on a successor page. The new version will become effective on the
	date it's posted, which will be listed at the top of the page as the new Effective Date.
</p>                            
                             
                            </div> 
                            
                          
							<li>
								<hr/>
								<label for="submit">By clicking submit you agree to the terms of service written above.</label>
								<input type="submit" name="register_user" id="submit" value="Submit" class="link_button large"/>
							</li>
						</ul>
					</fieldset>
				<?php echo form_close();?>
			</div>
		</div>
	</div>	