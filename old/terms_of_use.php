<?php 
	include("includes/header.php");
	include("includes/pagination.php");
?>

<script language="JavaScript" src="js/sendajax.js"></script>
<script language="JavaScript" src="js/scripts.js"></script>
<script type="text/javascript" src="js/subMenu.js"></script>
<script language="JavaScript">
function emailThisPage(url) {
    var newwindow = window.open(url, 'name', 'width=510,height=600,scrollbars=yes');
}

function bookmark_us(url, title) {
    if (window.sidebar) {
        var side;
        side = window.sidebar.addPanel(title, url, "");
    } else if (window.opera && window.print) {
        var elem = document.createElement('a');
        alert(elem);
        elem.setAttribute('href', url);
        elem.setAttribute('title', title);
        elem.setAttribute('rel', 'sidebar');
        elem.click();
    } else if (document.all)

        window.external.AddFavorite(url, title);
}
</script>
<div class="body-cont">

    <div class="body-cont1">
	<div class="body-leftcont">
            <?php include("includes/help_side_menu.php"); ?>
        </div>
        <div class="body-right">

            <?php include("includes/menu.php"); ?>

            <div class="tabs-cont" style="margin-top:0">
                <div class="left">
                    <div class="p-2" style="padding-top:0">
                        <div class="products-cate-heading" style="margin-bottom: 5px;"><h5><?php echo $terms_use; ?> <br>
                        <font style="font-size: 11px;">Last revised on August 1, 2020</font></h5>
                        </div>
                        <table style="line-height: 1.5">
                            <!-- <form id="form1" name="form1" method="post" action="">
                                < ?php 
                                    if($_SESSION['language']=='english')
                                    {
                                    $sel=mysqli_query($con,"select terms_conditions from cms");
                                    }
                                    else if($_SESSION['language']=='french')
                                    {
                                    $sel=mysqli_query($con,"select terms_conditions from cms_french");
                                    }
                                    else if($_SESSION['language']=='chinese')
                                    {
                                    $sel=mysqli_query($con,"select terms_conditions from cms_chinese");
                                    }
                                    else
                                    {
                                    $sel=mysqli_query($con,"select terms_conditions from cms_spanish");
                                    }
                                        //$sel=mysqli_query($con,"select terms_conditions from cms");
                                        $policy=mysqli_fetch_array($sel);
                                ?>
                                <tr>
                                    <td style="padding-left:10px;" valign="top">
                                        < ?php echo $policy['terms_conditions']; ?></td>
                                </tr>
                            </form> -->
                            <font>
                                <!-- <h3>Terms of Use</h3>  -->



                                

                                <h4><b>1. Acceptance of Terms of Use Agreement. </b></h4><br>

                                By creating a AnnexTrades account or by using any AnnexTrades service, whether through a mobile device, mobile application or computer (collectively, the “Service”) you agree to be bound by 
                                <br>
                                <br>(i) these Terms of Use, <br>
                                (ii) our Privacy Policy, Cookie Policy, Arbitration Procedures and Safety Tips, each of which is incorporated by reference into this Agreement, and 
                                <br>(iii) any terms disclosed to you if you purchase or have purchased additional features, products or services we offer on the Service (collectively, this “Agreement”). If you do not accept and agree to be bound by all of the terms of this Agreement, you should not use the Service. 
                                <br><br>
                                We may make changes to this Agreement and to the Service from time to time. We may do this for a variety of reasons including to reflect changes in or requirements of the law, new features, or changes in business practices. The most recent version of this Agreement will be posted on the Terms of Use posted on AnnexTrades.com, and you should regularly check for the most recent version. The most recent version is the version that applies. If the changes include material changes that affect your rights or obligations, we will notify you in advance of the changes by reasonable means, which could include notification through the Service or via email. If you continue to use the Service after the changes become effective, then you agree to the revised Agreement. You agree that this Agreement shall supersede any prior agreements (except as specifically stated herein), and shall govern your entire relationship with AnnexTrades, including but not limited to events, agreements, and conduct preceding your acceptance of this Agreement. 
                                <br><br>
                                

                                IF YOU DO NOT AGREE TO BE BOUND BY THIS AGREEMENT AND ABIDE BY ITS TERMS, YOU MAY NOT USE OR ACCESS THE ANNEXTRADES PLATFORM. 
                                    <br><br>
                                The AnnexTrades Platform is a web-based communications platform which enables connections between Sellers with Buyer and Service Providers with Clients.   
                                <br><br>
                                “Sellers” are individuals and/or companies seeking to sell their products to potential buyers.  “Buyers” are individuals that are seeking to purchase product.   
                                <br><br>
                                “Clients” are individuals and/or businesses seeking to obtain short or long-term services (“Services”) from Service Providers and are therefore clients of Service Providers, and “Service Providers” are businesses seeking to perform Services for Clients. Clients and Service Providers together are hereinafter referred to as “Users.” If you agree on the terms of a Service with another User, you and such other User form a Service Agreement directly between the two of you as set forth in more detail below. 
                                <br><br>
                                Any guidance we provide as part of our Services, such as pricing, shipping, listing, and sourcing is solely informational and you may decide to follow it or not. Also, while we may help facilitate the resolution of disputes through various programs, AnnexTrades has no control over and does not guarantee: the existence, quality, safety or legality of items advertised; the truth or accuracy of users' content or listings; the ability of sellers to sell items; the ability of buyers to pay for items; or that a buyer or seller will actually complete a transaction or return an item. 
                                <br><br>
                                THE SELLER OR SERVICE PROVIDERS ARE INDEPENDENT BUSINESS OWNERS. SELLERS AND SERVICE PROVIDERS ARE INDEPENDENT CONTRACTORS OF BUYERS AND CLIENTS AND NOT EMPLOYEES, PARTNERS, REPRESENTATIVES, AGENTS, JOINT VENTURERS, INDEPENDENT CONTRACTORS OR FRANCHISEES OF ANNEXTRADES. ANNEXTRADES DOES NOT SELL OR PERFORM SERVICES AND DOES NOT EMPLOY INDIVIDUALS TO PERFORM SERVICES. BY CONNECTING PEOPLE AND BUSINESSES SEEKING GOODS AND SERVICES WITH SELLERS AND SERVICE PROVIDERS, ANNEXTRADES OPERATES AS AN ONLINE MARKETPLACE THAT CONNECTS CLIENTS WITH SERVICE PROVIDERS WHO WISH TO PROVIDE A VARIETY OF SERVICES. 
                                <br><br>
                                USERS OF THIS PLATFORM HEREBY ACKNOWLEDGE THAT ANNEXTRADE DOES NOT SUPERVISE, SCOPE, DIRECT, CONTROL OR MONITOR A SELLER OR SERVICE PROVIDER WORK AND EXPRESSLY DISCLAIMS (TO THE EXTENT PERMITTED BY LAW) ANY RESPONSIBILITY AND LIABILITY FOR THE GOODS SOLD OR WORK PERFORMED AND THE SERVICE IN ANY MANNER, INCLUDING BUT NOT LIMITED TO A WARRANTY OR CONDITION OF GOOD AND WORKMANLIKE SERVICES, WARRANTY OR CONDITION OF QUALITY OR FITNESS FOR A PARTICULAR PURPOSE, OR COMPLIANCE WITH ANY LAW, STATUTE, ORDINANCE, REGULATION, OR CODE. 
                                <br><br>
                                Any reference on the AnnexTrades Platform to a seller (supplier) or service provider being licensed or credentialed in some manner, or "badged," “reliable,” “reliability rate,” “elite,” “great value,” "background checked," “vetted”, “verified seller” (or similar language) designations indicates only that the Service Provider has completed a relevant account process or met certain criteria and does not represent anything else. Any such description is not an endorsement, certification or guarantee by AnnexTrades of such supplier or service provider’s skills or qualifications or whether they are licensed, insured, trustworthy, safe or suitable. Instead, any such description is intended to be useful information for buyer and potential clients to evaluate when they make their own decisions about the identity and suitability of company or individual whom they contact or interact with via the AnnexTrades Platform. 
                                <br><br>
                                The AnnexTrades Platform enables connections between Users for the acquisition of goods and services. AnnexTrades is not responsible for the performance or communications of Users, nor does it have control over the quality, timing, legality, failure to provide, or any other aspect whatsoever of users, nor of the integrity, responsibility, competence, qualifications, or any of the actions or omissions whatsoever of any Users, or of any ratings or reviews provided by Users with respect to each other. AnnexTades makes no warranties or representations about the suitability, reliability, timeliness, or accuracy of the goods or services requested or services provided by, or the communications of or between, Users identified through the AnnexTrades Platform, whether in public or private, via on- or off-line interactions, or otherwise howsoever. 
                                <br><br>
                                AnnexTrades operates as an online marketplace that connects Sellers of goods with buyers and Service Providers with potential clients. AnnexTrades does not sell goods or perform services and does not employ people to perform services. Sellers and Service Providers operate as independent business owners and are customarily engaged in an independently established business of the same nature as that involved in the sale of goods or services performed for Clients through the AnnexTrades Platform. AnnexTrades does not control or direct the Seller or Service Provider’s quality of goods or performance of their services. Sellers and Service Providers provide goods and services under their own name or business name, and not under AnnexTrades’s name.  
                                <br><br>
                                The AnnexTrades Platform is not an employment agency service or business and AnnexTrades is not an employer of any User. All Users acknowledge and confirm that they are responsible for exercising their own business judgment in entering into Purchase and Service Agreements, depending on how they exercise such business judgment, there is a chance for individual profit or loss. 
                                <br><br><br>
                                <h4><b>2. Eligibility. </h4></b><br>

                                You must be at least 18 years of age to create an account on AnnexTrades and use the Service and otherwise capable of entering into binding contracts, in order to use or access the AnnexTrades Platform. 
                                <br><br>
                            

                                By creating an account and using the Service, you represent and warrant that: 
                                <br><br>
                                you are not a person who is barred from using the Service under the laws of the United States or any other applicable jurisdiction–meaning that you do not appear on the U.S. Treasury Department’s list of Specially Designated Nationals or face any other similar prohibition, 
                                <br><br>
                                you will comply with this Agreement and all applicable local, state, national and international laws, rules and regulations. 
                                <br><br>
                                Your agreement that AnnexTrades provides no warranty and has no liability regarding User action on the AnnexTrades Platform or the performance of Tasks. 
                                <br><br>
                                Your acknowledgment and agreement that AnnexTrades does not supervise, scope, direct, control, or monitor a Suppliers work and the Tasks performed. 
                                <br><br>
                                Your acknowledgement and agreement that Clients/Buyers are solely responsible for determining suitability of the product of interest and or if the Supplier or service provider they hire is qualified to perform the Task. 
                                <br><br>
                                Your acknowledgement and agreement that Suppliers or Service Providers are independent contractors of Clients and not employees, independent contractors or service providers of AnnexTrades. 
                                <br><br>
                                Your agreement to hold harmless and indemnify AnnexTrades from claims due to your use or inability to use the AnnexTrades Platform or content submitted from your account to the AnnexTrades Platform. 
                                <br><br>
                                For U.S. Users, your agreement to arbitrate disputes with AnnexTrades on an individual basis to the fullest extent permitted by applicable law, with other jurisdiction-specific means of dispute resolution set forth for Canadian, United Kingdom, and European Users. 
                                <br><br>
                                <br>
                                <h4><b>3. Modifying the Service and Termination.</b></h4><br>

                                AnnexTrades may add new product features or enhancements from time to time as well as remove some features.  When this occur, we may not provide you with notice before taking them. We may even suspend the Service entirely, in which event we will notify you in advance unless extenuating circumstances, such as safety or security concerns, prevent us from doing so. 
                                <br><br>
                                AnnexTrades may terminate your account at any time without notice if it believes that you have violated this Agreement. After your account is terminated. 
                                <br><br>
                                <br>
                                <h4><b>4. Rights AnnexTrades Grants You.</h4></b> <br>

                                AnnexTrades grants you a personal, worldwide, royalty-free, non-assignable, nonexclusive, revocable, and non-sublicensable license to access and use the Service. This license is for the sole purpose of letting you use and enjoy the Service’s benefits as intended by AnnexTrades and permitted by this Agreement. Therefore, you agree not to: 
                                    <br><br>
                                use the Service or any content contained in the Service for any commercial purposes without our written consent. 
                                <br><br>
                                copy, modify, transmit, create any derivative works from, make use of, or reproduce in any way any copyrighted material, images, trademarks, trade names, service marks, or other intellectual property, content or proprietary information accessible through the Service without AnnexTrades’s prior written consent. 
                                <br><br>
                                express or imply that any statements you make are endorsed by AnnexTrades. 
                                <br><br>
                                use any robot, bot, spider, crawler, scraper, site search/retrieval application, proxy or other manual or automatic device, method or process to access, retrieve, index, “data mine,” or in any way reproduce or circumvent the navigational structure or presentation of the Service or its contents. 
                                <br><br>
                                use the Service in any way that could interfere with, disrupt or negatively affect the Service or the servers or networks connected to the Service. 
                                <br><br>
                                upload viruses or other malicious code or otherwise compromise the security of the Service. 
                                <br><br>
                                forge headers or otherwise manipulate identifiers in order to disguise the origin of any information transmitted to or through the Service. 
                                <br><br>
                                “frame” or “mirror” any part of the Service without AnnexTrades’s prior written authorization. 
                                <br><br>
                                use meta tags or code or other devices containing any reference to AnnexTrades or the Service (or any trademark, trade name, service mark, logo or slogan of AnnexTrades) to direct any person to any other website for any purpose. 
                                <br><br>
                                modify, adapt, sublicense, translate, sell, reverse engineer, decipher, decompile or otherwise disassemble any portion of the Service, or cause others to do so. 
                                <br><br>
                                use or develop any third-party applications that interact with the Service or other members’ Content or information without our written consent. 
                                <br><br>
                                use, access, or publish the AnnexTrades application programming interface without our written consent. 
                                <br><br>
                                probe, scan or test the vulnerability of our Service or any system or network. 
                                <br><br>
                                encourage or promote any activity that violates this Agreement. 
                                <br><br>
                                AnnexTrades may investigate and take any available legal action in response to illegal and/ or unauthorized uses of the Service, including termination of your account. 
                                <br><br>
                                Any software that we provide you may automatically download and install upgrades, updates, or other new features. You may be able to adjust these automatic downloads through your device’s settings. 
                                <br><br>
                                <br>

                                <h4><b>5. Rights you Grant AnnexTrades. </h4></b><br>
                                    
                                    By creating an account, you grant to AnnexTrades a worldwide, transferable, sub-licensable, royalty-free, right and license to host, store, use, copy, display, reproduce, adapt, edit, publish, modify and distribute information you authorize us to access from Facebook, as well as any information you post, upload, display or otherwise make available (collectively, “post”) on the Service or transmit to other members (collectively, “Content”). AnnexTrades’s license to your Content shall be non-exclusive, except that AnnexTrades’s license shall be exclusive with respect to derivative works created through use of the Service. For example, AnnexTrades would have an exclusive license to screenshots of the Service that include your Content. In addition, so that AnnexTrades can prevent the use of your Content outside of the Service, you authorize AnnexTrades to act on your behalf with respect to infringing uses of your Content taken from the Service by other members or third parties. This expressly includes the authority, but not the obligation, to send notices pursuant to 17 U.S.C. § 512(c)(3) (i.e., DMCA Takedown Notices) on your behalf if your Content is taken and used by third parties outside of the Service. Our license to your Content is subject to your rights under applicable law (for example laws regarding personal data protection to the extent any Content contains personal information as defined by those laws) and is for the limited purpose of operating, developing, providing, and improving the Service and researching and developing new ones. You agree that any Content you place or that you authorize us to place on the Service may be viewed by other members and may be viewed by any person visiting or participating in the Service (such as individuals who may receive shared Content from other AnnexTrades members). 
                                    <br><br>
                                    You agree that all information that you submit upon creation of your account, including information submitted from your Facebook account, is accurate and truthful and you have the right to post the Content on the Service and grant the license to AnnexTrades above. 
                                    <br><br>
                                    You understand and agree that we may monitor or review any Content you post as part of a Service. We may delete any Content, in whole or in part, that in our sole judgment violates this Agreement or may harm the reputation of the Service. 
                                    <br><br>
                                    When communicating with our customer care representatives, you agree to be respectful and kind. If we feel that your behavior towards any of our customer care representatives or other employees is at any time threatening or offensive, we reserve the right to immediately terminate your account. 
                                    <br><br>
                                    In consideration for AnnexTrades allowing you to use the Service, you agree that we, our affiliates, and our third-party partners may place advertising on the Service. By submitting suggestions or feedback to AnnexTrades regarding our Service, you agree that AnnexTrades may use and share such feedback for any purpose without compensating you. 
                                    <br><br>
                                    You agree that AnnexTrades may access, preserve and disclose your account information and Content if required to do so by law or in a good faith belief that such access, preservation or disclosure is reasonably necessary, such as to: (i) comply with legal process; (ii) enforce this Agreement; (iii) respond to claims that any Content violates the rights of third parties; (iv) respond to your requests for customer service; or (v) protect the rights, property or personal safety of the Company or any other person. 
                                    <br><br>
                                    AnnexTrades reserves the right to investigate and/ or terminate your account without a refund of any purchases if you have violated this Agreement, misused the Service or behaved in a way that AnnexTrades regards as inappropriate or unlawful, including actions or communications that occur on or off the Service. 
                                    <br><br><br>
                                    

                                    <h4><b>6. Other Members’ Content.</h4></b> <br>

                                    Although AnnexTrades reserves the right to review and remove Content that violates this Agreement, such Content is the sole responsibility of the member who posts it, and AnnexTrades cannot guarantee that all Content will comply with this Agreement. If you see Content on the Service that violates this Agreement, please report it within the Service or via our contact form. 
                                    <br><br>
                                    “User Generated Content” is defined as any information and materials you provide to AnnexTrades, its corporate partners, or other Users in connection with your registration for and use of the AnnexTrades Platform and participation in AnnexTrades promotional campaigns, including without limitation the information and materials posted or transmitted for use in Public Areas. You are solely responsible for User Generated Content, and we act merely as a passive conduit for your online distribution and publication of your User Generated Content. You acknowledge and agree that AnnexTrades is not involved in the creation or development of User Generated Content, disclaims any responsibility for User Generated Content, and cannot be liable for claims arising out of or relating to User Generated Content. Further, you acknowledge and agree that AnnexTrades has no obligation to monitor or review User Generated Content, but reserves the right to limit or remove User Generated Content if it is not compliant with the terms of this Agreement. 
                                    <br><br>
                                    You hereby represent and warrant to AnnexTrades that your User Generated Content (a) will not be false, inaccurate, incomplete or misleading; (b) will not be fraudulent or involve the transfer or sale of illegal, counterfeit or stolen items; (c) will not infringe on any third party’s privacy, or copyright, patent, trademark, trade secret or other proprietary right or rights of publicity or personality (to the extent recognized by law in the country where the goods originate or service is performed); (d) will not violate any law, statute, ordinance, code, or regulation (including without limitation those governing export control, consumer protection, unfair competition, anti-discrimination, incitement of hatred or false or misleading advertising, anti-spam or privacy); (e) will not be defamatory, libellous, malicious, threatening, or harassing; (f) will not be obscene or contain pornography (including but not limited to child pornography) or be harmful to minors; (g) will not contain any viruses, scripts such as Trojan Horses, SQL injections, worms, time bombs, corrupt files, cancelbots or other computer programming routines that are intended to damage, detrimentally interfere with, surreptitiously intercept or expropriate any system, data or personal information; (h) will not claim or suggest in any way that you are employed or directly engaged by or affiliated with AnnexTrades or otherwise purport to act as a representative or agent of AnnexTrades; and (i) will not create liability for AnnexTrades or cause AnnexTrades to lose (in whole or in part) the services of its Internet Service Providers (ISPs) or other partners or suppliers. 
                                    <br><br>
                                    The AnnexTrades Platform hosts User Generated Content relating to reviews and ratings of specific Taskers (“Feedback”). Feedback is such User’s opinion and not the opinion of AnnexTrades, and has not been verified or approved by AnnexTrades. You agree that AnnexTrades is not responsible or liable for any Feedback or other User Generated Content. AnnexTrades encourages each User to give objective, constructive and honest Feedback about the other Users with whom they have transacted. AnnexTrades is not obligated to investigate any remarks posted by Users for accuracy or reliability or to consider any statements or materials posted or submitted by Users about any Feedback but may do so at its discretion. You agree that Feedback enables Users to post and other Users to read about Users’ expression of their experiences and that you will not complain or take any action merely because you happen to disagree with such feedback. You may request removal of a review that violates this Agreement or the AnnexTrades Ratings and Reviews Policy by contacting the Support team at help.tr.co. Each Client should undertake their own research to be satisfied that a specific Tasker has the right qualifications for a Task. 
                                    <br><br>
                                    AnnexTrades respects the personal and other rights of others, and expects Users to do the same. AnnexTrades is entitled to identify a User to third parties who claim that their rights have been infringed by User Generated Content submitted by that User, so that they may attempt to resolve the claim directly. 
                                    <br><br>
                                    If a User believes, in good faith, that any User Generated Content provided on or in connection with the AnnexTrades Platform is objectionable or infringes any of its rights or the rights of others (e.g. counterfeiting, insult, invasion of privacy), the User is encouraged to notify AnnexTrades. If a User discovers that User Generated Content promotes crimes against humanity, incites hatred and/or violence, or concerns child pornography, the User must notify the AnnexTrades. Such notification can be made at ANNEXTRADES, 110 SE 6th Street, Suite 1700 Ft. Lauderdale, Florida 33301 
                                    <br><br><br>
                                    <h4><b>7. Purchases. </h4></b><br>

                                    Generally. From time to time, AnnexTrades may offer products and services for purchase (“in app purchases”), AnnexTrades direct billing or other payment platforms authorized by AnnexTrades. If you choose to make an in app purchase, you will be prompted to confirm your purchase with the applicable payment provider, and your method of payment (be it your card or a third party account such as Google Play or iTunes) (your “Payment Method”) will be charged at the prices displayed to you for the service(s) you’ve selected as well as any sales or similar taxes that may be imposed on your payments, and you authorize AnnexTrades or the third party account, as applicable, to charge you. 
                                    <br><br>
                                    
                                    Auto-Renewal. If you purchase an auto-recurring periodic subscription or service, your Payment Method will continue to be billed for the subscription until you cancel. After your initial subscription commitment period, and again after any subsequent subscription period, your subscription will automatically continue for an additional equivalent period, at the price you agreed to when subscribing. Deleting your account on AnnexTrades or deleting the AnnexTrades application from your device does not cancel your subscription; AnnexTrades will retain all funds charged to your Payment Method until you cancel your subscription on AnnexTrades or the third-party account, as applicable. If you cancel your subscription, you may use your subscription until the end of your then-current subscription term, and your subscription will not be renewed after your then-current term expires. 
                                    <br><br>
                                    Additional Terms that apply if you pay AnnexTrades directly with your Payment Method. If you pay AnnexTrades directly, AnnexTrades may correct any billing errors or mistakes that it makes even if it has already requested or received payment. If you initiate a chargeback or otherwise reverse a payment made with your Payment Method, AnnexTrades may terminate your account immediately in its sole discretion. 
                                    <br><br>
                                    You may edit your Payment Method information by visiting AnnexTrades and going to Settings. If a payment is not successfully settled, due to expiration, insufficient funds, or otherwise, and you do not edit your Payment Method information or cancel your subscription, you remain responsible for any uncollected amounts and authorize us to continue billing the Payment Method, as it may be updated. This may result in a change to your payment billing dates. In addition, you authorize us to obtain updated or replacement expiration dates and card numbers for your credit or debit card as provided by your credit or debit card issuer. The terms of your payment will be based on your Payment Method and may be determined by agreements between you and the financial institution, credit card issuer or other provider of your chosen Payment Method.  
                                    <br><br>
                                    
                                    <h4><b>8. Notice and Procedure for Making Claims of Copyright Infringement. </h4></b><br>
                                    If you believe that your work has been copied and posted on the Service in a way that constitutes copyright infringement, please provide our Copyright Agent with the following information: 
                                        <br><br>
                                    an electronic or physical signature of the person authorized to act on behalf of the owner of the copyright interest; 
                                    <br><br>
                                    a description of the copyrighted work that you claim has been infringed; 
                                    <br><br>
                                    a description of where the material that you claim is infringing is located on the Service (and such description must be reasonably sufficient to enable us to find the alleged infringing material); 
                                    <br><br>
                                    your contact information, including address, telephone number and email address; 
                                    <br><br>
                                    a written statement by you that you have a good faith belief that the disputed use is not authorized by the copyright owner, its agent, or the law; and 
                                    <br><br>
                                    a statement by you, made under penalty of perjury, that the above information in your notice is accurate and that you are the copyright owner or authorized to act on the copyright owner’s behalf. 
                                    <br><br>
                                    Notice of claims of copyright infringement should be provided to the Company’s Copyright Agent via email to copyright@annextrades.com,  
                                    by phone to 888-614-2950 or via mail to the following address: 
                                    <br><br>
                                    Copyright Compliance Department c/o Match Group Legal 110 SE 6th Street, Suite 1700 Ft. Lauderdale, Florida 33301 
                                    <br><br>
                                    AnnexTrades will terminate the accounts of repeat infringers. 
                                    <br><br>
                                    <h4><b>9. Disclaimers. </b></h4>
                                    <br>
                                    ANNEXTRADES PROVIDES THE SERVICE ON AN “AS IS” AND “AS AVAILABLE” BASIS AND TO THE EXTENT PERMITTED BY APPLICABLE LAW, GRANTS NO WARRANTIES OF ANY KIND, WHETHER EXPRESS, IMPLIED, STATUTORY OR OTHERWISE WITH RESPECT TO THE SERVICE (INCLUDING ALL CONTENT CONTAINED THEREIN), INCLUDING, WITHOUT LIMITATION, ANY IMPLIED WARRANTIES OF SATISFACTORY QUALITY, MERCHANTABILITY, FITNESS FOR A PARTICULAR PURPOSE OR NON-INFRINGEMENT. ANNEXTRADES DOES NOT REPRESENT OR WARRANT THAT (A) THE SERVICE WILL BE UNINTERRUPTED, SECURE OR ERROR FREE, (B) ANY DEFECTS OR ERRORS IN THE SERVICE WILL BE CORRECTED, OR (C) THAT ANY CONTENT OR INFORMATION YOU OBTAIN ON OR THROUGH THE SERVICE WILL BE ACCURATE. 
                                    <br><br>
                                    ANNEXTRADES TAKES NO RESPONSIBILITY FOR ANY CONTENT THAT YOU OR ANOTHER MEMBER OR THIRD PARTY POSTS, SENDS OR RECEIVES THROUGH THE SERVICE. ANY MATERIAL DOWNLOADED OR OTHERWISE OBTAINED THROUGH THE USE OF THE SERVICE IS ACCESSED AT YOUR OWN DISCRETION AND RISK. 
                                    <br><br>
                                    ANNEXTRADES DISCLAIMS AND TAKES NO RESPONSIBILITY FOR ANY CONDUCT OF YOU OR ANY OTHER MEMBER, ON OR OFF THE SERVICE. 
                                    <br><br>
                                    <h4><b>10. Third Party Services.</b></h4><br><br>

                                    The Service may contain advertisements and promotions offered by third parties and links to other web sites or resources. AnnexTrades is not responsible for the availability (or lack of availability) of such external websites or resources. If you choose to interact with the third parties made available through our Service, such party’s terms will govern their relationship with you. AnnexTrades is not responsible or liable for such third parties’ terms or actions. 
                                    <br><br>
                                    
                                    <b>Limitation of Liability. </b><br><br>

                                    TO THE FULLEST EXTENT PERMITTED BY APPLICABLE LAW, IN NO EVENT SHALL ANNEXTRADES, ITS AFFILIATES, EMPLOYEES, LICENSORS OR SERVICE PROVIDERS BE LIABLE FOR ANY INDIRECT, CONSEQUENTIAL, EXEMPLARY, INCIDENTAL, SPECIAL, PUNITIVE, OR ENHANCED DAMAGES, INCLUDING, WITHOUT LIMITATION, LOSS OF PROFITS, WHETHER INCURRED DIRECTLY OR INDIRECTLY, OR ANY LOSS OF DATA, USE, GOODWILL, OR OTHER INTANGIBLE LOSSES, RESULTING FROM: (I) YOUR ACCESS TO OR USE OF OR INABILITY TO ACCESS OR USE THE SERVICE; (II) THE CONDUCT OR CONTENT OF OTHER MEMBERS` OR THIRD PARTIES ON, THROUGH OR FOLLOWING USE OF THE SERVICE; OR (III) UNAUTHORIZED ACCESS, USE OR ALTERATION OF YOUR CONTENT, EVEN IF ANNEXTRADES HAS BEEN ADVISED AT ANY TIME OF THE POSSIBILITY OF SUCH DAMAGES. NOTWITHSTANDING THE FOREGOING, IN NO EVENT SHALL ANNEXTRADES’S AGGREGATE LIABILITY TO YOU FOR ANY AND ALL CLAIMS ARISING OUT OF OR RELATING TO THE SERVICE OR THIS AGREEMENT EXCEED THE AMOUNT PAID, IF ANY, BY YOU TO ANNEXTRADES DURING THE TWENTY-FOUR (24) MONTH PERIOD IMMEDIATELY PRECEDING THE DATE THAT YOU FIRST FILE A LAWSUIT, ARBITRATION OR ANY OTHER LEGAL PROCEEDING AGAINST ANNEXTRADES, WHETHER IN LAW OR IN EQUITY, IN ANY TRIBUNAL. THE DAMAGES LIMITATION SET FORTH IN THE IMMEDIATELY PRECEDING SENTENCE APPLIES (i) REGARDLESS OF THE GROUND UPON WHICH LIABILITY IS BASED (WHETHER DEFAULT, CONTRACT, TORT, STATUTE, OR OTHERWISE), (ii) IRRESPECTIVE OF THE TYPE OF BREACH OF OBLIGATIONS, AND (iii) WITH RESPECT TO ALL EVENTS, THE SERVICE, AND THIS AGREEMENT. 
                                    <br><br>
                                    THE LIMITATION OF LIABILITY PROVISIONS SET FORTH IN THIS SECTION  SHALL APPLY EVEN IF YOUR REMEDIES UNDER THIS AGREEMENT FAIL WITH RESPECT TO THEIR ESSENTIAL PURPOSE. 
                                    <br><br>
                                    SOME JURISDICTIONS DO NOT ALLOW THE EXCLUSION OR LIMITATION OF CERTAIN DAMAGES, SO SOME OR ALL OF THE EXCLUSIONS AND LIMITATIONS IN THIS SECTION MAY NOT APPLY TO YOU. 
                                    <br><br>

                                    Retroactive and Prospective Arbitration, Class-Action Waiver, and Jury Waiver. 
                                    <br><br>
                                Except where prohibited by applicable law: 
                                <br><br>
                                The exclusive means of resolving any dispute or claim arising out of or relating to this Agreement (including any alleged breach thereof), or the Service, regardless of the date of accrual and including past, pending, and future claims, shall be BINDING ARBITRATION administered by JAMS under the JAMS Streamlined Arbitration Rules & Procedures, except as modified by our Arbitration Procedures. The one exception to the exclusivity of arbitration is that either party has the right to bring an individual claim against the other in a small claims court of competent jurisdiction, or, if filed in arbitration, the responding party may request that the dispute proceed in small claims court instead if the claim is within the jurisdiction of the small claims court. If the request to proceed in small claims court is made before an arbitrator has been appointed, the arbitration shall be administratively closed. If the request to proceed in small claims court is made after an arbitrator has been appointed, the arbitrator shall determine whether the dispute should remain in arbitration or instead be decided in small claims court. Such arbitration shall be conducted by written submissions only, unless either you or AnnexTrades elect to invoke the right to an oral hearing before the Arbitrator. But whether you choose arbitration or small claims court, you agree that you will not under any circumstances commence, maintain, or participate in any class action, class arbitration, or other representative action or proceeding against AnnexTrades. 
                                <br><br>
                                By accepting this Agreement, you agree to the Arbitration Agreement in this Section 12 (subject to the limited one-time right to opt out within thirty (30) days belonging to members who first created an account or used the Service prior to August 1, 2020 (such members, “Legacy Members"), discussed below). In doing so, BOTH YOU AND ANNEXTRADES GIVE UP THE RIGHT TO GO TO COURT to assert or defend any claims between you and AnnexTrades (except for matters that may be properly taken to a small claims court and are within such court’s jurisdiction). YOU ALSO GIVE UP YOUR RIGHT TO PARTICIPATE IN A CLASS ACTION OR OTHER CLASS PROCEEDING, including, without limitation, any past, pending or future class actions. 
                                <br><br>
                                If you assert a claim against AnnexTrades outside of small claims court (and AnnexTrades does not request that the claim be moved to small claims court), your rights will be determined by a NEUTRAL ARBITRATOR, NOT A JUDGE OR JURY, and the arbitrator shall determine all claims and all issues regarding the arbitrability of the dispute. The same is true for AnnexTrades. Both you and AnnexTrades are entitled to a fair hearing before the arbitrator. The arbitrator can generally grant the relief that a court can, including the ability to hear a dispositive motion (which may include a dispositive motion based upon the parties’ pleadings, as well as a dispositive motion based upon the parties’ pleadings along with the evidence submitted), but you should note that arbitration proceedings are usually simpler and more streamlined than trials and other judicial proceedings. Decisions by the arbitrator are enforceable in court and may be overturned by a court only for very limited reasons. For details on the arbitration process, see our Arbitration Procedures . 
                                <br><br>
                                The Jurisdiction and Venue provisions are incorporated and are applicable to this Arbitration Agreement. 
                                <br><br>
                                As you decide whether to agree to this Arbitration Agreement, here are some important considerations: 
                                <br><br>
                                Arbitration is a process of private dispute resolution that does not involve the civil courts, a civil judge or a jury. Instead, the parties’ dispute is decided by a private arbitrator selected by the parties under the JAMS Streamlined Arbitration Rules & Procedures. Arbitration does not limit or affect the legal claims you as an individual may bring against AnnexTrades. Agreeing to arbitration will only affect where those claims may be brought and how they will be resolved. 
                                <br><br>
                                <h4><b>13. Indemnity by You. </b></h4><br>

                                You agree, to the extent permitted under applicable law, to indemnify, defend and hold harmless AnnexTrades, our affiliates, and our respective officers, directors, agents, and employees from and against any and all complaints, demands, claims, damages, losses, costs, liabilities and expenses, including attorney’s fees, due to, arising out of, or relating in any way to your access to or use of the Service, your Content, or your breach of this Agreement. 
                                <br><br>
                                

                                <h4><b>14. Entire Agreement; Other.</h4></b><br>
                                

                                This Agreement, along with the Privacy Policy, Cookie Policy, and Arbitration Procedures, and any terms disclosed to you if you purchase or have purchased additional features, products or services we offer on the Service, contains the entire agreement between you and AnnexTrades regarding your relationship with AnnexTrades and the use of the Service. If any provision of this Agreement is held invalid, the remainder of this Agreement shall continue in full force and effect. The failure of AnnexTrades to exercise or enforce any right or provision of this Agreement shall not constitute a waiver of such right or provision. You agree that your AnnexTrades account is non-transferable and all of your rights to your account and its Content terminate upon your death. No agency, partnership, joint venture, fiduciary or other special relationship or employment is created as a result of this Agreement and you may not make any representations on behalf of or bind AnnexTrades in any manner. 
                                <br><br>
                                
                                <h4><b>15. Disclaimer of Warranties </b></h4><br>

                                <b>(a) Use Of The AnnexTrades Platform Is Entirely At Your Own Risk </b>
                                <br><br>
                                THE TECHNOLOGY OF THE ANNEXTRADES PLATFORM IS PROVIDED ON AN “AS IS” BASIS WITHOUT WARRANTIES OR CONDITIONS OF ANY KIND, EITHER EXPRESS OR IMPLIED, INCLUDING, BUT NOT LIMITED TO, WARRANTIES OR CONDITIONS OF MERCHANTABILITY, FITNESS FOR A PARTICULAR PURPOSE, GOOD AND WORKMANLIKE SERVICES, AND NON-INFRINGEMENT. ANNEXTRADES MAKES NO WARRANTIES OR REPRESENTATIONS ABOUT THE ACCURACY OR COMPLETENESS OF THE CONTENT PROVIDED THROUGH THE ANNEXTRADES PLATFORM OR THE CONTENT OF ANY SITES LINKED TO THE ANNEXTRADES PLATFORM AND ASSUMES NO LIABILITY OR RESPONSIBILITY IN CONTRACT, WARRANTY OR IN TORT FOR ANY (I) ERRORS, MISTAKES, OR INACCURACIES OF CONTENT, (II) PERSONAL INJURY OR PROPERTY DAMAGE, OF ANY NATURE WHATSOEVER, RESULTING FROM YOUR ACCESS TO AND USE OF THE ANNEXTRADES PLATFORM, (III) ANY ACCESS TO OR USE OF OUR SECURE SERVERS AND/OR ANY AND ALL PERSONAL INFORMATION AND/OR FINANCIAL INFORMATION STORED THEREIN; AND (IV) EVENTS BEYOND OUR REASONABLE CONTROL. 
                                <br><br>
                                AnnexTrades does not warrant, endorse, guarantee or assume responsibility for any goods or service advertised or offered by a third-party through the AnnexTrades Platform or any hyperlinked website or featured in any banner or other advertising, and AnnexTrades will not be a party to or in any way be responsible for monitoring any transaction between you and other Users, or you and third-party providers of products or services. As with the purchase of a product or service through any medium or in any environment, you should use your best judgment and exercise caution where appropriate. Without limiting the foregoing, AnnexTrades and Affiliates do not warrant that access to the AnnexTrades Platform will be uninterrupted or that the AnnexTrades Platform will be error-free; nor do they make any warranty as to the results that may be obtained from the use of the AnnexTrades Platform, or as to the timeliness, accuracy, reliability, completeness or content of any Task, service, information or materials provided through or in connection with the use of the AnnexTrades Platform. AnnexTrades and Affiliates are not responsible for the conduct, whether online or offline, of any User. AnnexTrades and Affiliates do not warrant that the AnnexTrades Platform is free from computer viruses, system failures, worms, trojan horses, or other harmful components or malfunctions, including during hyperlink to or from third-party websites. AnnexTrades and Affiliates will implement appropriate technical and organizational measures to ensure a level of security adapted to the risk for any personal information supplied by you. 
                                <br><br>
                                Notwithstanding any feature a Client may use to expedite AnnexTrades selection, each Client is responsible for determining the Service and selecting their Service Provider and AnnexTrades does not warrant any goods or services purchased by a Client and does not recommend any particular Service Provider. AnnexTrades does not provide any warranties or guarantees regarding any Service Provider’s ability, professional accreditation, registration or license. 
                                <br><br>
                                <b>(b) No Liability </b>
                                <br><br>
                                You acknowledge and agree that AnnexTrades is only willing to provide the AnnexTrades Platform if you agree to certain limitations of our liability to you and third parties. Therefore, you agree not to hold AnnexTrades and Affiliates, or their corporate partners, liable for any claims, demands, damages, expenses, losses, governmental obligations, suits, and/or controversies of every kind and nature, known and unknown, suspected and unsuspected, disclosed and undisclosed, direct, indirect, incidental, actual, consequential, economic, special, or exemplary, including attorney’s fees and costs (collectively, “Liabilities”) that have arisen or may arise, relating to your or any other party’s use of or inability to use the AnnexTrades Platform, including without limitation any Liabilities arising in connection with the conduct, act or omission of any User, any dispute with any User, any instruction, advice, act, or service provided by AnnexTrades and Affiliates, and any destruction of your User Generated Content. 
                                <br><br>
                                UNDER NO CIRCUMSTANCES WILL ANNEXTRADES AND AFFILIATES OR THEIR CORPORATE PARTNERS BE LIABLE FOR, AND YOU HEREBY RELEASE ANNEXTRADES AND AFFILIATES AND THEIR CORPORATE PARTNERS FROM ANY DIRECT, INDIRECT, INCIDENTAL, ACTUAL, CONSEQUENTIAL, ECONOMIC, SPECIAL OR EXEMPLARY DAMAGES (INCLUDING BUT NOT LIMITED TO LOST PROFITS, LOSS OF DATA, LOSS OF GOODWILL, SERVICE INTERRUPTION, COMPUTER DAMAGE, SYSTEM FAILURE, FAILURE TO STORE ANY INFORMATION OR OTHER CONTENT MAINTAINED OR TRANSMITTED BY ANNEXTRADES, THE COST OF SUBSTITUTE PRODUCTS OR SERVICES, OR ATTORNEYS FEES AND COSTS) ARISING OUT OF OR IN ANY WAY CONNECTED WITH YOUR USE OF OR INABILITY TO USE THE ANNEXTRADES PLATFORM OR THE TASK SERVICES, EVEN IF ADVISED OF THE POSSIBILITY OF THE SAME. SOME JURISDICTIONS DO NOT ALLOW THE EXCLUSION OF CERTAIN WARRANTIES OR LIMITATION OF INCIDENTAL OR CONSEQUENTIAL DAMAGES; IN SUCH CASES THE ABOVE LIMITATIONS MAY NOT APPLY TO YOU IN THEIR ENTIRETY. 
                                <br><br>
                                ANNEXTRADES AND AFFILIATES EXPRESSLY DISCLAIM ANY LIABILITY THAT MAY ARISE BETWEEN USERS OF ITS ANNEXTRADES PLATFORM. ANNEXTRADES AND AFFILIATES ALSO DO NOT ACCEPT ANY LIABILITY WITH RESPECT TO THE QUALITY OR FITNESS OF ANY WORK PERFORMED VIA THE ANNEXTRADES PLATFORM. 
                                <br><br>
                                IF, NOTWITHSTANDING THE FOREGOING EXCLUSIONS, IT IS DETERMINED THAT ANNEXTRADES AND AFFILIATES OR THEIR CORPORATE PARTNERS ARE LIABLE FOR DAMAGES, IN NO EVENT WILL THE AGGREGATE LIABILITY, WHETHER ARISING IN CONTRACT, TORT, STRICT LIABILITY OR OTHERWISE, EXCEED THE TOTAL FEES PAID BY YOU TO ANNEXTRADES (IF YOU ARE A CLIENT) OR TOTAL SERVICE PAYMENTS PAID TO YOU BY CLIENTS (IF YOU ARE A SERVICE PROVIDER), DURING THE 6 MONTHS PRIOR TO THE TIME SUCH CLAIM AROSE, TO THE EXTENT PERMITTED BY APPLICABLE LAW. 
                                <br><br>
                                <h4><b>16. Listing Conditions </b></h4><br>

                                When listing an item for sale on our platform, you agree to comply with AnnexTrades Listing policies and Selling practices policy and that: 
                                    <br><br>
                                You assume full responsibility for the item offered and the accuracy and content of the listing. 
                                <br><br>
                                Your listing may not be immediately searchable by keyword or category for several hours (or up to 24 hours in some circumstances). AnnexTrades can't guarantee exact listing duration, 
                                <br><br>
                                Your fixed-price listings may renew automatically every calendar month, based on the listing terms at the time, until all quantities sell or the listing is ended by you or AnnexTrades, in its sole discretion, 
                                <br><br>
                                Content that violates any of AnnexTrades policies may be modified, obfuscated or deleted at AnnexTrades sole discretion, 
                                <br><br>
                                We may revise product data associated with listings to supplement, remove, or correct information, 
                                <br><br>
                                To drive a positive user experience, a listing may not appear in some search and browse results regardless of the sort order chosen by the buyer, 
                                <br><br>
                                Some advanced listing upgrades will only be visible on some of our Services, 
                                <br><br>
                                AnnexTrades Duplicate listings Policy may also affect whether your listing appears in search results, 
                                <br><br>
                                Metatags and URL links that are included in a listing may be removed or altered so as to not affect third-party search engine results, 
                                <br><br>
                                We may provide you with optional recommendations to consider when creating your listings. Such recommendations may be based on the aggregated sales and performance history of similar sold and current listings; results may vary for individual listings. To drive the recommendations experience, you agree that we may display the sales and performance history of your individual listings to other sellers, 
                                <br><br>
                                For items listed in certain categories, subject to certain programs, and/or offered or sold at certain price points, AnnexTrades may require the use of certain payment methods, subject to our Payments methods policy. For example, for inventory covered by authentication services, buyer and sellers may be subject to escrow, screening, shipping, and/or payment handling requirements. 
                                <br><br>
                                

                                <h4><b>17. Purchase Conditions </b></h4><br>
                                
                                When buying an item on our platform, you agree to the Rules and policies for buyers and that: 
                                    <br><br>
                                You are responsible for reading the full item listing before making a request for purchase or committing to buy, 
                                <br><br>
                                You enter into a legally binding contract to purchase an item when you commit to buy an item, your offer for an item is accepted. 
                                <br><br>
                                <h4><b>18. International Buying and Selling; Translation </h4></b><br>

                                Many of our Services are accessible internationally.  
                                <br><br>
                                Sellers and buyers are responsible for complying with all laws and regulations applicable to the international sale, purchase, and shipment of items. 
                                <br><br>
                                If you purchase an item on an AnnexTrades site that is different from your registration site, you are subject to the User Agreement and applicable policies of that other AnnexTrades site with respect to that particular purchase, as detailed in the International Selling Policy. 
                                <br><br>
                                For sellers, you agree that we may display your listing for sale on an AnnexTrades site other than the site where you listed your item for sale, based on your shipping settings. You may adjust these settings as detailed in the International Selling Policy. If you list your items with an international shipping option, the appearance of your listings on sites other than the listing site is not guaranteed. If you sell an item on an AnnexTrades site that is different from your registration site, you are subject to the User Agreement and applicable policies, including any buyer protection programs, of that other AnnexTrades site with respect to that particular sale, as detailed in the International Selling Policy. 
                                <br><br>
                                You authorize us to use automated tools to translate your AnnexTrades content and member-to-member communications, in whole or in part, into local languages where such translation solutions are available. We may provide you with tools which will enable you to translate content at your request. The accuracy and availability of any translation are not guaranteed. 
                                <br><br>
                                <h4><b>19. Managed Payments </h4></b><br>

                                AnnexTrades uses a 3rd Party firm to managed payments service, where a designated AnnexTrades entity (each, a "payments entity") manages payments on behalf of sellers (such management described as "managed payments" or similar). Some AnnexTrades sellers have already enrolled in managed payments. AnnexTrades anticipates moving more seller accounts to managed payments in phases starting in July 2020, providing notice to the affected sellers as they are scheduled to be moved. 
                                <br><br>
                                When we enable your account for managed payments, to continue to list and sell on AnnexTrades, as directed by the payment’s entity, each seller registered in the US must: 
                                    <br><br>
                                provide the payments entity with information about you and/or your business to meet its compliance requirements, including those involving identity verification, anti-money laundering controls, and sanctions screening as required by applicable laws and policies; and 
                                <br><br>
                                pass such verification and screening and otherwise meet the compliance requirements of the payment’s entity, as determined by the payment’s entity; and 
                                <br><br>
                                provide bank account information for a U.S.-based checking account or internationally recognized banking institution so that the payments entity can link such checking account to your AnnexTrades account, allowing the payments entity to pay you. 

                                
                                <br><br>
                                <b>In addition:</b> 
                                <br><br>
                                the payments entity may obtain information about you from third-parties to verify your identity, comply with anti-money laundering and sanctions screening obligations, and for other purposes in connection with managed payments; and 
                                <br><br>
                                the payments entity may use third-party payments service providers to assist it in providing managed payments services, including companies that process payments, perform risk assessments (such as credit agencies) or compliance checks, verify identity, and validate payment methods. AnnexTrades, the payments entity, and their affiliates may send personal data associated with you and your account to such third-parties. 
                                <br><br>
                                

                                The payments entity may, in its sole discretion, manage payments on your behalf even if you haven't provided all requested information, and the payments entity may withhold payouts pending receipt of such information. 
                                <br><br>
                                The complete terms governing sellers' use of managed payments are available in the Payments Terms of Use, incorporated herein. You agree to the Payments Terms of Use to the extent applicable to you, whether or not your account has been enabled for managed payments. 
                                <br><br>
                                The contract for sale underlying the purchase of goods is directly concluded between seller and the buyer in the same manner as for transactions for which the payments entity does not manage payments. 
                                <br><br>
                                If you are a buyer completing a purchase from a seller that is using managed payments: 
                                <br><br>
                                You may pay for such items using those payment methods that the payments entity makes available, and the payments entity will manage settlement to sellers. By completing purchases from sellers who use managed payments, buyers authorize the payments entity to initiate payments using the buyers' selected payment method and collect the transaction amounts on behalf of sellers.  Accordingly, payments received by the payments entity from buyers satisfy buyers' obligations to pay sellers in the amount of payments received. 
                                <br><br>
                                In certain instances, your transaction may be declined, frozen, or held for any reason including for suspected fraud, AML compliance, compliance with economic or trade sanctions, in connection with AnnexTrades's internal risk controls or due to potential violations of any policy of AnnexTrades or the payments entity, or a policy of one of the payments entity's third party payments services providers. 
                                <br><br>
                                AnnexTrades, the payments entity or its affiliates may save payment information, such as credit card or debit card numbers, and card expiration dates, entered by you on our Services when you make a purchase, redeem a coupon, or make any other transaction on our Services where card information is entered. Such stored payment information may be used as your default payment method for future transactions on our Services. At any time, you can update your card information or enter new card information, at which point the new card information shall be stored as your default payment method. You may make changes to your default payment method through the Personal Information section under the Account tab in My AnnexTrades. You are responsible for maintaining the accuracy of information we have on file, and you consent to AnnexTrades updating such stored information from time to time based on information provided by you, your bank or other payments services providers. You will only provide information about payment methods that you are authorized to use. 
                                <br><br>
                                You may seek returns or cancellations on our Services in the same manner as you do for transactions for which the payments entity does not manage payments. The payments entity refunds amounts paid for successful AnnexTrades Money Back Guarantee claims and returned or cancelled transactions in cases where the original payment was managed by the payments entity. Refund timing may vary in accordance with the rules of third parties, such as credit and debit card networks. 
                                <br><br>
                                You agree to comply with, and not cause a third party to violate, all applicable laws, regulations, rules and terms and conditions in connection with the use of managed payments. You understand that some third parties, such as credit and debit card issuers, credit and debit card networks and payments services providers, may have their own terms and conditions for the payment or settlement methods you choose to use in connection with managed payments transactions. Failure to abide by third party terms and conditions may result in fees assessed to you (for example, currency conversion fees from your credit card issuer if the transaction currency is different from your credit card currency) or other actions taken by such third parties, and you agree that the payments entity has no control over, or responsibility or liability for, such fees or actions. 

  
                            </font>
                        </table>
                    </div>

                </div>
            </div>

        </div>

        <div class="body-cont4">

        </div>

    </div>


</div>


</div>

<?php include("includes/footer.php"); ?>