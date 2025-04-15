**This Extension is retired**

We have retired this extension in April 2025. Please read the details in our blogpost https://www.marketing-factory.com/blog/were-retiring-beuser-iprange

**What does it do?**
- It gives the possibility to configure a valid IP-range for BE-users
- There are 2 vars for configuration: one for admins and one for other be-user

IP-ranges are configured in a comma-list. Only v4-addresses are valid.

_Examples_:
- 192.168.0.1-192.168.0.15  is valid for any IP-address from  192.168.0.1 to 192.168.0.15
- 127.0.0.1-127.0.0.1 is valid for a single IP-address 127.0.0.1 (only from local machine)


**Configuration**

Use localconf.php for configuration.

- For Admins: 
`$GLOBALS['TYPO3_CONF_VARS']['BE']['adminAuth']['ipRange'] = '192.168.0.1-192.168.0.15,96.0.112.80-96.0.112.96';`
- For other BE-users: 
`$GLOBALS['TYPO3_CONF_VARS']['BE']['userAuth']['ipRange'] = '192.168.0.1-192.168.0.15,96.0.112.80-96.0.112.96'; `
