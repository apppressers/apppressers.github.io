
<div id='ml-initial-details' style="display:none;">
    <table class="form-table">
        <tbody>
            <tr valign="top">
                <th scope="row">Your name</th>
                <td>
                    <input size="36" type="text" id="ml-user-name" name="contactName" placeholder="Enter your name" value='' required>
                </td>
            </tr>
            <tr valign="top">
                <th scope="row">Your email</th>
                <td>
                    <input size="36" type="email" id="ml-user-email" name="email" placeholder="Enter your email" value='<?php echo wp2android::get_option('ml_user_email', $current_user->user_email); ?>' required>
                </td>
            </tr>
            <tr valign="top">
                <th scope="row">Your website</th>
                <td>
                    <input size="36" type="text" id="ml-user-site" name="website" placeholder="Enter your website" value='<?php echo wp2android::get_option('ml_site_url', get_site_url()); ?>'>
                </td>
            </tr>
            <tr>
                <td colspan='2'>
                    <small>By using wp2android you agree to wp2android's <a target="_blank" href="http://www.wp2android.wps.edu.vn/terms/<?php echo get_option('affiliate_link', null); ?>">Terms of service</a> and <a target="_blank" href="http://www.wp2android.wps.edu.vn/privacy/<?php echo get_option('affiliate_link', null); ?>">Privacy policy</a> </small>
                </td>
            </tr>
        </tbody>
    </table>
</div>