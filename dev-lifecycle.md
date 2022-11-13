[<< Return to documentation overview](README.md)

# Dev lifecycle

This is a guide to the development lifecycle of the project for TP 2022/2023. It is a living document and will be updated as the project progresses. The original version with Jenkins auto-building, Sonatype Nexus can be found [here](https://github.com/xkohutka/documentation/blob/ea75369f3f2f7a7617b0aedace446922b83c5ced/dev-lifecycle.md).

Whether you are working on a new feature or fixing a bug, you are probably working with a Jira issue. Each issue has its own lifecycle, and the lifecycle of an issue is determined by its status. The status of an issue is usually set by the issue's assignee, and the assignee is usually the person who is responsible for the issue. Each issue also has a handler, who is the person currently working on the issue. The handler is usually the the same person at the assignee, but it can also be the tester in the later stages of the issue's lifecycle.

## Starting work on an issue

When you start working on an issue, you should assign it to yourself. This lets other people know that you are working on the issue, and it prevents other people from working on the issue at the same time.

Free Jira issues can be found in the `TO DO` column of the Jira board. If you see an issue that you would like to work on, assign it to yourself and move it to the `IN PROGRESS` column. You can assign an issue to yourself by inserting your name into the `Assignee` and `Handler` fields.

Each issue should have its own branch, which is derived from the `master` branch (or whatever our main branch will be). The branch name should be in the following format: `issue-<Jira ID>`, so if the Jira is AS-1234, the branch name should be `issue-1234`.

## Finishing work on an issue

When you are done working on an issue, you should move it to the `TEST` column. At this point, you should also create a pull request for your branch. The pull request should be reviewed by another developer, and the reviewer should merge the pull request into the `master` branch (or whatever our main branch will be). The reviewer should be specified in the `Assignee` field of the Jira issue.

## Testing an issue

When an issue is moved to the `TEST` column, it is ready to be tested. The tester should move the issue to the `DONE` column when they are done testing it. If the tester finds any problems with the issue, they should move the issue back to the `TO DO` column and change the `Assignee` field to the original assignee.
