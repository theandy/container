#
# Add SQL definition of database tables
#

CREATE TABLE tt_content (
    tx_container_bg_section int(11) unsigned DEFAULT '0' NOT NULL,
    tx_container_bg_col_1 int(11) unsigned DEFAULT '0' NOT NULL,
    tx_container_bg_col_2 int(11) unsigned DEFAULT '0' NOT NULL,
    tx_container_bg_col_3 int(11) unsigned DEFAULT '0' NOT NULL,
    tx_container_bg_col_4 int(11) unsigned DEFAULT '0' NOT NULL,
    tx_container_classes_section VARCHAR(255) DEFAULT '0' NOT NULL,
    tx_container_classes_container VARCHAR(255) DEFAULT '0' NOT NULL,
    tx_container_classes_row VARCHAR(255) DEFAULT '0' NOT NULL,
    tx_container_classes_col_1 VARCHAR(255) DEFAULT '0' NOT NULL,
    tx_container_classes_col_2 VARCHAR(255) DEFAULT '0' NOT NULL,
    tx_container_classes_col_3 VARCHAR(255) DEFAULT '0' NOT NULL,
    tx_container_classes_col_4 VARCHAR(255) DEFAULT '0' NOT NULL,
    tx_container_classes_col_5 VARCHAR(255) DEFAULT '0' NOT NULL,
    tx_container_classes_col_6 VARCHAR(255) DEFAULT '0' NOT NULL,
);