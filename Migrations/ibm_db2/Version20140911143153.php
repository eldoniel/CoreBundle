<?php

namespace Claroline\CoreBundle\Migrations\ibm_db2;

use Doctrine\DBAL\Migrations\AbstractMigration;
use Doctrine\DBAL\Schema\Schema;

/**
 * Auto-generated migration based on mapping information: modify it with caution
 *
 * Generation date: 2014/09/11 02:31:54
 */
class Version20140911143153 extends AbstractMigration
{
    public function up(Schema $schema)
    {
        $this->addSql("
            CREATE TABLE claro_workspace_model_user (
                user_id INTEGER NOT NULL, 
                workspacemodel_id INTEGER NOT NULL, 
                PRIMARY KEY(user_id, workspacemodel_id)
            )
        ");
        $this->addSql("
            CREATE INDEX IDX_5318388FA76ED395 ON claro_workspace_model_user (user_id)
        ");
        $this->addSql("
            CREATE INDEX IDX_5318388FD500BD91 ON claro_workspace_model_user (workspacemodel_id)
        ");
        $this->addSql("
            CREATE TABLE claro_workspace_model_group (
                group_id INTEGER NOT NULL, 
                workspacemodel_id INTEGER NOT NULL, 
                PRIMARY KEY(group_id, workspacemodel_id)
            )
        ");
        $this->addSql("
            CREATE INDEX IDX_1F19A8AEFE54D947 ON claro_workspace_model_group (group_id)
        ");
        $this->addSql("
            CREATE INDEX IDX_1F19A8AED500BD91 ON claro_workspace_model_group (workspacemodel_id)
        ");
        $this->addSql("
            CREATE TABLE claro_workspace_model (
                id INTEGER GENERATED BY DEFAULT AS IDENTITY NOT NULL, 
                workspace_id INTEGER DEFAULT NULL, 
                name VARCHAR(255) NOT NULL, 
                PRIMARY KEY(id)
            )
        ");
        $this->addSql("
            CREATE INDEX IDX_536FFC4C82D40A1F ON claro_workspace_model (workspace_id)
        ");
        $this->addSql("
            CREATE TABLE claro_workspace_model_home_tab (
                workspacemodel_id INTEGER NOT NULL, 
                hometab_id INTEGER NOT NULL, 
                PRIMARY KEY(workspacemodel_id, hometab_id)
            )
        ");
        $this->addSql("
            CREATE INDEX IDX_A8E0CB1BD500BD91 ON claro_workspace_model_home_tab (workspacemodel_id)
        ");
        $this->addSql("
            CREATE INDEX IDX_A8E0CB1BCCE862F ON claro_workspace_model_home_tab (hometab_id)
        ");
        $this->addSql("
            CREATE TABLE claro_workspace_model_resource (
                id INTEGER GENERATED BY DEFAULT AS IDENTITY NOT NULL, 
                resource_node_id INTEGER NOT NULL, 
                model_id INTEGER NOT NULL, 
                isCopy SMALLINT NOT NULL, 
                PRIMARY KEY(id)
            )
        ");
        $this->addSql("
            CREATE INDEX IDX_F5D706351BAD783F ON claro_workspace_model_resource (resource_node_id)
        ");
        $this->addSql("
            CREATE INDEX IDX_F5D706357975B7E7 ON claro_workspace_model_resource (model_id)
        ");
        $this->addSql("
            ALTER TABLE claro_workspace_model_user 
            ADD CONSTRAINT FK_5318388FA76ED395 FOREIGN KEY (user_id) 
            REFERENCES claro_user (id) 
            ON DELETE CASCADE
        ");
        $this->addSql("
            ALTER TABLE claro_workspace_model_user 
            ADD CONSTRAINT FK_5318388FD500BD91 FOREIGN KEY (workspacemodel_id) 
            REFERENCES claro_workspace_model (id) 
            ON DELETE CASCADE
        ");
        $this->addSql("
            ALTER TABLE claro_workspace_model_group 
            ADD CONSTRAINT FK_1F19A8AEFE54D947 FOREIGN KEY (group_id) 
            REFERENCES claro_group (id) 
            ON DELETE CASCADE
        ");
        $this->addSql("
            ALTER TABLE claro_workspace_model_group 
            ADD CONSTRAINT FK_1F19A8AED500BD91 FOREIGN KEY (workspacemodel_id) 
            REFERENCES claro_workspace_model (id) 
            ON DELETE CASCADE
        ");
        $this->addSql("
            ALTER TABLE claro_workspace_model 
            ADD CONSTRAINT FK_536FFC4C82D40A1F FOREIGN KEY (workspace_id) 
            REFERENCES claro_workspace (id) 
            ON DELETE CASCADE
        ");
        $this->addSql("
            ALTER TABLE claro_workspace_model_home_tab 
            ADD CONSTRAINT FK_A8E0CB1BD500BD91 FOREIGN KEY (workspacemodel_id) 
            REFERENCES claro_workspace_model (id) 
            ON DELETE CASCADE
        ");
        $this->addSql("
            ALTER TABLE claro_workspace_model_home_tab 
            ADD CONSTRAINT FK_A8E0CB1BCCE862F FOREIGN KEY (hometab_id) 
            REFERENCES claro_home_tab (id) 
            ON DELETE CASCADE
        ");
        $this->addSql("
            ALTER TABLE claro_workspace_model_resource 
            ADD CONSTRAINT FK_F5D706351BAD783F FOREIGN KEY (resource_node_id) 
            REFERENCES claro_resource_node (id) 
            ON DELETE CASCADE
        ");
        $this->addSql("
            ALTER TABLE claro_workspace_model_resource 
            ADD CONSTRAINT FK_F5D706357975B7E7 FOREIGN KEY (model_id) 
            REFERENCES claro_workspace_model (id) 
            ON DELETE CASCADE
        ");
    }

    public function down(Schema $schema)
    {
        $this->addSql("
            ALTER TABLE claro_workspace_model_user 
            DROP FOREIGN KEY FK_5318388FD500BD91
        ");
        $this->addSql("
            ALTER TABLE claro_workspace_model_group 
            DROP FOREIGN KEY FK_1F19A8AED500BD91
        ");
        $this->addSql("
            ALTER TABLE claro_workspace_model_home_tab 
            DROP FOREIGN KEY FK_A8E0CB1BD500BD91
        ");
        $this->addSql("
            ALTER TABLE claro_workspace_model_resource 
            DROP FOREIGN KEY FK_F5D706357975B7E7
        ");
        $this->addSql("
            DROP TABLE claro_workspace_model_user
        ");
        $this->addSql("
            DROP TABLE claro_workspace_model_group
        ");
        $this->addSql("
            DROP TABLE claro_workspace_model
        ");
        $this->addSql("
            DROP TABLE claro_workspace_model_home_tab
        ");
        $this->addSql("
            DROP TABLE claro_workspace_model_resource
        ");
    }
}