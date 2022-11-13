[<< Return to documentation overview](README.md)

# Dev lifecycle

This is a guide to the development lifecycle of the project for TP 2022/2023. It is a living document and will be updated as the project progresses. The original version with Jenkins auto-building, Sonatype Nexus can be found [here](https://github.com/xkohutka/documentation/blob/ea75369f3f2f7a7617b0aedace446922b83c5ced/dev-lifecycle.md).

Whether you are working on a new feature or fixing a bug, you are probably working with a Jira issue. Each issue has its own lifecycle with its own stages: `TO DO`, `IN PROGRESS`, `TEST` and `DONE`. Each issue has also multiple attributes, the most important ones being:

- **ID**: Unique identifier in the format `AS-<number>`.
- **Assignee**: The person responsible for the issue.
- **Handler**: Person currently working on the issue. This is usually the same as **Assignee**, but it can be a tester as well.

Anytime you move an issue to a different lifecycle stage (apart from `TO DO`->`IN PROGRESS`), you should comment it in the issue itself. 

*For example: If you finish your work and move the issue from `IN PROGRESS` to `TEST`, please attach a link to your pull request.*

## Starting work on an issue

When you start working on an issue, you should assign it to yourself. This lets other people know that you are working on the issue, and it prevents other people from working on the issue at the same time. The steps are as follows:

1. Choose an issue you want to work on from the `TO DO` column in Jira.
2. Change the `Assignee` and `Handler`to yourself.
3. Move the issue from the `TO DO` column to the `IN PROGRESS` column.
4. Create a new branch from the `master` branch (or whatever our main branch will be). The name of the branch should be in the format `issue-<Jira ID>`, e.g. `issue-123` for `issue-123`.
5. Work on your issue.

## Finishing work on an issue

Once you are satisfied with your work, you can do the following:

1. Create a pull request on GitHub. Do not forget to specify a reviewer, who will take a look at your code.
2. Move the issue from the `IN PROGRESS` column to the `DONE` column.
3. Change the `Handler` to the reviewer specified in the pull request.

## Testing an issue

If you have been assigned as a reviewer, you are supposed to test you colleague's solution. You should not only test, whether the code is functional, but also if it makes sense/is readable.

1. Review the code.
2. If there is something wrong:
   1. Document the mistakes and request changes. Feel free to suggest changes yourself.
   2. Change the `Handler` to the original assignee in Jira.
   3. Return the issue back to the `TO DO` column.
3. If everything is fine:
   1. Merge the pull request.
   2. Delete the branch.
   3. Move the issue to the `DONE` column.
