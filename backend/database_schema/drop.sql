# ---------------------------------------------------------------------- #
# Script generated with: DeZign for Databases 11.0.4                     #
# Target DBMS:           MySQL 5                                         #
# Project file:          db.dez                                          #
# Project name:                                                          #
# Author:                                                                #
# Script type:           Database drop script                            #
# Created on:            2019-06-27 01:17                                #
# ---------------------------------------------------------------------- #


# ---------------------------------------------------------------------- #
# Drop foreign key constraints                                           #
# ---------------------------------------------------------------------- #

ALTER TABLE `bus` DROP FOREIGN KEY `bus_ibfk_1`;

ALTER TABLE `bus_service` DROP FOREIGN KEY `bus_service_ibfk_1`;

ALTER TABLE `depot` DROP FOREIGN KEY `depot_ibfk_1`;

ALTER TABLE `reservation` DROP FOREIGN KEY `trip_reservation`;

ALTER TABLE `trip` DROP FOREIGN KEY `trip_ibfk_1`;

ALTER TABLE `trip` DROP FOREIGN KEY `bus_trip`;

# ---------------------------------------------------------------------- #
# Drop table "reservation"                                               #
# ---------------------------------------------------------------------- #

# Drop constraints #

DROP TABLE `reservation`;

# ---------------------------------------------------------------------- #
# Drop table "trip"                                                      #
# ---------------------------------------------------------------------- #

# Remove autoinc for PK drop #

ALTER TABLE `trip` MODIFY `trip_id` INTEGER NOT NULL;

# Drop constraints #

DROP TABLE `trip`;

# ---------------------------------------------------------------------- #
# Drop table "depot"                                                     #
# ---------------------------------------------------------------------- #

# Remove autoinc for PK drop #

ALTER TABLE `depot` MODIFY `depot_id` INTEGER NOT NULL;

# Drop constraints #

DROP TABLE `depot`;

# ---------------------------------------------------------------------- #
# Drop table "bus"                                                       #
# ---------------------------------------------------------------------- #

# Drop constraints #

DROP TABLE `bus`;

# ---------------------------------------------------------------------- #
# Drop table "mailing_list"                                              #
# ---------------------------------------------------------------------- #

# Remove autoinc for PK drop #

ALTER TABLE `mailing_list` MODIFY `id` INTEGER NOT NULL;

# Drop constraints #

DROP TABLE `mailing_list`;

# ---------------------------------------------------------------------- #
# Drop table "district"                                                  #
# ---------------------------------------------------------------------- #

# Remove autoinc for PK drop #

ALTER TABLE `district` MODIFY `district_id` INTEGER NOT NULL;

# Drop constraints #

DROP TABLE `district`;

# ---------------------------------------------------------------------- #
# Drop table "customer_registry"                                         #
# ---------------------------------------------------------------------- #

# Drop constraints #

DROP TABLE `customer_registry`;

# ---------------------------------------------------------------------- #
# Drop table "bus_service"                                               #
# ---------------------------------------------------------------------- #

# Drop constraints #

DROP TABLE `bus_service`;

# ---------------------------------------------------------------------- #
# Drop table "bus_boundary"                                              #
# ---------------------------------------------------------------------- #

# Remove autoinc for PK drop #

ALTER TABLE `bus_boundary` MODIFY `boundary_id` INTEGER NOT NULL;

# Drop constraints #

DROP TABLE `bus_boundary`;
