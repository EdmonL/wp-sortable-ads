<?php
if (!defined('SORTABLE_ADS')) {
    exit;
}
?>
<div class="wrap">

<h1><?= esc_html(get_admin_page_title()) ?></h1>

<h2>Ad Placement Policy</h2>
<p>
Sortable works with many sources of demand that have varying placement policies. Our policy is what we enforce for our more sensitive partners. We look at each unit individually to ensure it is compliant with our policy. If a unit is not compliant, it will not be eligible for some of our more sensitive demand partners. This does not mean that non-compliant units will not serve ads, but they may have reduced performance.
</p>

<h4>Number of Ads per page</h4>
<p>
We allow 5 ads per page, and one additional ad every 800px below the fold for long form content. Sticky ads are allowed to remain in viewport with these additional units.
</p>

<h4>Number of Ads Above the Fold</h4>
<p>
The "Fold" is a term used to describe the bottom of the viewport on an initial pageload before scrolling. If the person visiting you site has a screen height of 900px, all ads and content that is in the first 900px is considered "Above the Fold" or ATF. All content and ads after the 900px mark are considered "Below the Fold" or BTF. Note that scroll position of the user is not part of this equation.
</p>
<dl>
<dt>Desktop</dt><dd>No Retriction</dd>
<dt>Tablet</dt><dd>2 ads</dd>
<dt>Smartphone</dt><dd>1 ad</dd>
</dl>

<h4>Ad Sizes Above the Fold</h4>
<p>
Some ad sizes are not allowed ATF.
</p>
<dl>
<dt>Desktop</dt><dd>No Retriction</dd>
<dt>Tablet</dt><dd>No 336x280 or 300x600</dd>
<dt>Smartphone</dt><dd>No 728x90, 160x600, 336x280, or 300x600</dd>
</dl>

<h4>Iframes</h4>
<p>
Ads cannot be inserted inside of iframes.
</p>

<h2>Troubleshooting Ads</h2>
<h4>No Ads</h4>
<p>
Check that you have implemented the code properly. If you are using caching plugins you should do a cache purge.
</p><p>
Verify that you have the right Site Domain in your settings. Put this into your browser's address bar: <code>//tags-cdn.deployads.com/a/[SITE DOMAIN].js</code>.
</p><p>
Are you trying to serve ads on a different domain than the one registered with Sortable? We authenticate that the domain of the website is registered to your account.
</p>

<h4>Responsiveness of ads</h4>
<p>
If the page doesn't have <code>initial-scale=1</code> in the header, the the page is not responsive and the size of the viewport will not change on different devices. In this case, responsive ad units (and the corresponding css on this page) will likely not work correctly. Look in the page source for something like this: <code>&lt;meta name="viewport" content="initial-scale=1"/&gt;</code>.
</p><p>
Since ads respond to the size of the container, you should make sure that the container is allowing the ad to be the correct size.
</p>

<h4>Refresh</h4>
<p>
Some partners have specific refresh restrictions that we enforce. If one of these partners wins the impression we will wait 60 seconds before a refresh is allowed for that impression regardless of the declaration on the ad unit.
</p><p>
We limit the number of refreshes for each ad to 10. You can talk to your Sortable representative about increasing the max if there is a special case.
</p><p>
We prevent refreshes on ad units that haven't fully loaded, and ad units that have not been visible.
</p>

<h2>Advanced</h2>
<h4>User and Event Refesh</h4>
<p>
To trigger a user refresh (e.g. when the user clicks the next button on a slideshow) or an event refresh (e.g. a video stopped playing), integrate the following javascript code to trigger the refresh:
<pre>
window.deployads.push(function() {
window.deployads.refreshAds(document.getElementById('some-id'), 'user');
});
</pre>
'some-id' is the id of an element containing the ads you want to refresh. All ads contained within the element are refreshed.
<br/>
'user' is the type of refresh, can be 'user' or 'event'.
</p><p>
Keep in mind that, depending on the bid winner, the refresh may be blocked until certain conditions are met.
</p>

</div>
