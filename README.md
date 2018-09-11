# Woocommerce
Woocommerce REST API date filter

<h3>Steps to upload the plugin</h3>
Step 1: Zip the file into a folder.<br>
Step 2: Upload the zip in Woocommerce by clicking on Upload Plugin as zip file.<br>
Step 3: Activate the plugin.

<h3>How to use the filter</h3>
<h4>Rest Customer API by using after account creation date both for verson v1 and v2</h4>
    
    front-url/wp-json/wc/v1/customers?created_after=2018-04-20T10:42:35
    
<h4>Rest Customer API by using after/before/exact account updation date both for verson v1 and v2</h4>
    
    front-url/wp-json/wc/v2/customers?filter[meta_key]=last_update&filter[meta_value]=2018-09-10T06:43:07&last_update={eq/after/before}
    
<h4>Rest Product API by using after modified date both for verson v1 and v2</h4>
    
    front-url/wp-json/wc/v1/products?modified_after=2018-04-20T10:42:35
    
<h4>Rest Product API by using before modified date both for verson v1 and v2</h4>
    
    front-url/wp-json/wc/v1/products?modified_before=2018-03-31T09:33:44
    
<h4>Rest Order API by using after modified date both for verson v1 and v2</h4>
    
    front-url/wp-json/wc/v1/orders?modified_after=2018-04-20T10:42:35
    
<h4>Rest Order API by using before modified date both for verson v1 and v2</h4>

    front-url/wp-json/wc/v1/orders?modified_before=2018-03-31T09:33:44
