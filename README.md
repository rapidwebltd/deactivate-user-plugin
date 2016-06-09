# Deactivate User Plugin for WordPress

[![Code Climate](https://codeclimate.com/github/rapidwebltd/deactivate-user-plugin/badges/gpa.svg)](https://codeclimate.com/github/rapidwebltd/deactivate-user-plugin) [![StyleCI](https://styleci.io/repos/37912211/shield)](https://styleci.io/repos/37912211)

WordPress plugin that allows a user to deactivate their own user account from within the WordPress login area, or via the shortcode.

To create a frontend page that immediately deactivates the currently logged in user's account, use the following short code. This can be useful when developing a custom frontend.

```
[jhdup_deactivate_current_user_shortcode]
```

Note: When a user's account is deactivated all their posts/pages are set to 'draft' status.
