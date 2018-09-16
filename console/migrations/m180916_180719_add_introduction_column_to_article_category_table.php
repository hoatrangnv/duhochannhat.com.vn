<?php

use yii\db\Migration;

/**
 * Handles adding introduction to table `article_category`.
 */
class m180916_180719_add_introduction_column_to_article_category_table extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $this->addColumn('article_category', 'introduction', $this->text()->after('long_description'));
    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        $this->dropColumn('article_category', 'introduction');
    }
}
