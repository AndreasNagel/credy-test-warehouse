<?php

use yii\db\Migration;

/**
 * Class m180627_100822_init_rbac
 */
class m180627_100822_init_rbac extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $auth = Yii::$app->authManager;

        // add "createProduct" permission
        $createProduct = $auth->createPermission('createProduct');
        $createProduct->description = 'Create a product';
        $auth->add($createProduct);

        // add "updateProduct" permission
        $updateProduct = $auth->createPermission('updateProduct');
        $updateProduct->description = 'Update product';
        $auth->add($updateProduct);
        
        // add "createUser" permission
        $createUser = $auth->createPermission('createUser');
        $createUser->description = 'Create a user';
        $auth->add($createUser);

        // add "updateProduct" permission
        $updateUser = $auth->createPermission('updateUser');
        $updateUser->description = 'Update user';
        $auth->add($updateUser);
        
        // add "author" role and give this role the "createProduct" permission
        $author = $auth->createRole('author');
        $auth->add($author);
        $auth->addChild($author, $createProduct);

        // add "admin" role and give this role the "updateProduct" permission
        // as well as the permissions of the "author" role
        $admin = $auth->createRole('admin');
        $auth->add($admin);
        $auth->addChild($admin, $updateProduct);
        $auth->addChild($admin, $createUser);
        $auth->addChild($admin, $author);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        echo "m180627_100822_init_rbac cannot be reverted.\n";

        return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m180627_100822_init_rbac cannot be reverted.\n";

        return false;
    }
    */
}
