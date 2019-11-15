<?php

use yii\db\Migration;

/**
 * Class m191113_024530_init_rbac
 */
class m191113_024530_init_rbac extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $auth = Yii::$app->authManager;

        $createPost = $auth->createPermission('createPost');
        $createPost->description = 'Create a post';
        $auth->add($createPost);

        $updatePost = $auth->createPermission('updatePost');
        $updatePost->description = 'Update post';
        $auth->add($updatePost);

        $author = $auth->createRole('author');
        $auth->add($author);
        $auth->addChild($author,$createPost);

        $admin = $auth->createRole('admin');
        $auth->add($admin);
        $auth->addChild($admin, $updatePost);
        $auth->addChild($admin, $author);

        $auth->assign($author,2);
        $auth->assign($admin,1);

    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
//        echo "m191113_024530_init_rbac cannot be reverted.\n";
//
//        return false;

        $auth = Yii::$app->authManager;
        $auth->removeAll();
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m191113_024530_init_rbac cannot be reverted.\n";

        return false;
    }
    */
}
