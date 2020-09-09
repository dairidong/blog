INSERT INTO `admin_menu`(`id`, `parent_id`, `order`, `title`, `icon`, `uri`, `created_at`, `updated_at`) VALUES (1, 0, 1, 'Index', 'feather icon-bar-chart-2', '/', '2020-08-28 14:44:50', NULL);
INSERT INTO `admin_menu`(`id`, `parent_id`, `order`, `title`, `icon`, `uri`, `created_at`, `updated_at`) VALUES (2, 0, 5, 'Admin', 'feather icon-settings', '', '2020-08-28 14:44:50', '2020-09-07 22:59:23');
INSERT INTO `admin_menu`(`id`, `parent_id`, `order`, `title`, `icon`, `uri`, `created_at`, `updated_at`) VALUES (3, 2, 6, 'Users', '', 'auth/users', '2020-08-28 14:44:50', '2020-09-07 22:59:23');
INSERT INTO `admin_menu`(`id`, `parent_id`, `order`, `title`, `icon`, `uri`, `created_at`, `updated_at`) VALUES (4, 2, 7, 'Roles', '', 'auth/roles', '2020-08-28 14:44:50', '2020-09-07 22:59:23');
INSERT INTO `admin_menu`(`id`, `parent_id`, `order`, `title`, `icon`, `uri`, `created_at`, `updated_at`) VALUES (5, 2, 8, 'Permission', '', 'auth/permissions', '2020-08-28 14:44:50', '2020-09-07 22:59:23');
INSERT INTO `admin_menu`(`id`, `parent_id`, `order`, `title`, `icon`, `uri`, `created_at`, `updated_at`) VALUES (6, 2, 9, 'Menu', '', 'auth/menu', '2020-08-28 14:44:50', '2020-09-07 22:59:23');
INSERT INTO `admin_menu`(`id`, `parent_id`, `order`, `title`, `icon`, `uri`, `created_at`, `updated_at`) VALUES (7, 2, 10, 'Operation log', '', 'auth/logs', '2020-08-28 14:44:50', '2020-09-07 22:59:23');
INSERT INTO `admin_menu`(`id`, `parent_id`, `order`, `title`, `icon`, `uri`, `created_at`, `updated_at`) VALUES (8, 0, 3, '文章', 'fa-file', '/posts', '2020-08-28 14:47:07', '2020-08-28 17:19:07');
INSERT INTO `admin_menu`(`id`, `parent_id`, `order`, `title`, `icon`, `uri`, `created_at`, `updated_at`) VALUES (9, 0, 2, '分类', 'fa-sitemap', '/categories', '2020-08-28 17:19:00', '2020-08-28 17:19:07');
INSERT INTO `admin_menu`(`id`, `parent_id`, `order`, `title`, `icon`, `uri`, `created_at`, `updated_at`) VALUES (10, 0, 4, '网站设置', 'fa-globe', '/settings', '2020-09-07 22:59:18', '2020-09-07 22:59:23');
INSERT INTO `admin_permissions`(`id`, `name`, `slug`, `http_method`, `http_path`, `order`, `parent_id`, `created_at`, `updated_at`) VALUES (1, 'Auth management', 'auth-management', '', '', 1, 0, '2020-08-28 14:44:50', NULL);
INSERT INTO `admin_permissions`(`id`, `name`, `slug`, `http_method`, `http_path`, `order`, `parent_id`, `created_at`, `updated_at`) VALUES (2, 'Users', 'users', '', '/auth/users*', 2, 1, '2020-08-28 14:44:50', NULL);
INSERT INTO `admin_permissions`(`id`, `name`, `slug`, `http_method`, `http_path`, `order`, `parent_id`, `created_at`, `updated_at`) VALUES (3, 'Roles', 'roles', '', '/auth/roles*', 3, 1, '2020-08-28 14:44:50', NULL);
INSERT INTO `admin_permissions`(`id`, `name`, `slug`, `http_method`, `http_path`, `order`, `parent_id`, `created_at`, `updated_at`) VALUES (4, 'Permissions', 'permissions', '', '/auth/permissions*', 4, 1, '2020-08-28 14:44:50', NULL);
INSERT INTO `admin_permissions`(`id`, `name`, `slug`, `http_method`, `http_path`, `order`, `parent_id`, `created_at`, `updated_at`) VALUES (5, 'Menu', 'menu', '', '/auth/menu*', 5, 1, '2020-08-28 14:44:50', NULL);
INSERT INTO `admin_permissions`(`id`, `name`, `slug`, `http_method`, `http_path`, `order`, `parent_id`, `created_at`, `updated_at`) VALUES (6, 'Operation log', 'operation-log', '', '/auth/logs*', 6, 1, '2020-08-28 14:44:50', NULL);
INSERT INTO `admin_role_users`(`role_id`, `user_id`, `created_at`, `updated_at`) VALUES (1, 1, NULL, NULL);
INSERT INTO `admin_roles`(`id`, `name`, `slug`, `created_at`, `updated_at`) VALUES (1, 'Administrator', 'administrator', '2020-08-28 14:44:50', '2020-08-28 14:44:50');
INSERT INTO `admin_users`(`id`, `username`, `password`, `name`, `avatar`, `remember_token`, `created_at`, `updated_at`) VALUES (1, 'admin', '$2y$10$kHX1ZLxPNjF6pR8TY.KVEO4.IEIjJREj0hH1KRI7M0l2pexIuZPMe', 'Administrator', NULL, 'w2I5rF0BMtrigyofWCflfYjQQlYRpQitkRlnwm6vHw1lw1o7bOojczJin6D0', '2020-08-28 14:44:50', '2020-08-28 14:44:50');
