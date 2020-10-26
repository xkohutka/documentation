# ASICDE - Parent modules

This repository holds a list of Maven dependencies of the project (used in [api](https://github.com/ASICDE/asicde-api) and [backend](https://github.com/ASICDE/asicde-backend)).

## BOM

Bill of materials used to prescribe versions for the whole project

*NOTE: BOM imports work in a first come - first serve basis.*

### Adding entry to BOM
1. Check whether it is not already listed in spring BOM (spring-boot-dependencies)
2. If it is not listed or you need another version add a new dependency in BOM
3. Do not use scope in `<dependencyManagement>`. It is advised to let the end user decide

### Service parent
Parent for all Spring Boot services

### Parent
Parent for all other modules - libraries, commons, etc.

## Managing versions
1. Versions are managed via properties
2. We use format `versions.xxx` for the properties

## Managing Plugins
As Maven uses BOM to manage plugin versions and configuration it is needed to add plugin management section to both service-parent and parent. Please double-check that the version configured is same in both.
