<?php
// $Id$

/**
 * @file
 * Hooks provided by the Organic groups module.
 */

/**
 * @addtogroup hooks
 * @{
 */

/**
 * Add group permissions.
 */
function hook_og_permission() {
  return array(
    'subscribe' => array(
      'title' => t('Subscribe user to group'),
      'description' => t("Allow user to be a member of a group (approval required)."),
      'roles' => array(OG_ANONYMOUS_ROLE),
    ),
  );
}

/**
 * Set the default permissions to be assigned to members, by their role.
 */
function hook_og_default_permissions() {
  return array(
    'foo' => array(OG_AUTHENTICATED_ROLE),
  );
}

/**
 * Define group context handlers.
 *
 * @return
 *   Array keyed with the context handler name and an array of properties:
 *   - callback: The callback function that should return a an array of group
 *     IDs.
 *   - menu: TRUE indicates that the handler will try to find a context by the
 *     current menu item. Defaults to TRUE.
 *   - menu path: If "menu" property is TRUE, this property is required.
 *     An array of path the handler should be invoked. For example,
 *     if the user is viewing a node, the menu system is "node/%", and all
 *     group context handlers with this matching path, will be invoked.
 *   - priority: Optional; Indicate if the context result of this handler should
 *     be treated as a priority. A use case can be for example, the "session"
 *     context handler that returns the group context that is stored in the
 *     $_SESSION. By giving it a priority, we make sure that even if viewing
 *     different pages, the user will see the same group context.
 *     @see og_context_handler_session().
 */
function hook_og_context_handlers() {
  $items = array();

  $items['foo'] = array(
    'callback' => 'foo_context_handler_bar',
    'menu path' => array('foo/%', 'foo/%/bar'),
  );

  return $items;
}

/**
 * Alter the group context handlers.
 */
function hook_og_context_handlers_alter(&$items) {
  // Add another menu path that should invoke this handler.
  $items['foo']['menu path'][] = 'foo/%/baz';
}


/**
 * Set a default role that will be used as a global role.
 *
 * A global role, is a role that is assigned by default to all new groups.
 */
function hook_og_default_roles() {
  return array('super admin');
}

function hook_og_users_roles_grant($nid, $uid, $rid) {

}

function hook_og_users_roles_revoke($nid, $uid, $rid) {

}

/**
 * @} End of "addtogroup hooks".
 */