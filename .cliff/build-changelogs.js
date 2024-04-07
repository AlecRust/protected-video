const { execSync } = require('child_process')
const packageJson = require('../package.json')

const nextVersion = packageJson.version
const changelogMdCmd = `git-cliff --config .cliff/cliff-changelog-md.toml -o CHANGELOG.md --tag v${nextVersion}`
const readmeTxtCmd = `git-cliff --config .cliff/cliff-readme-txt.toml -o readme.txt --tag v${nextVersion}`

try {
  execSync(changelogMdCmd, { stdio: 'inherit' })
  execSync(readmeTxtCmd, { stdio: 'inherit' })
} catch (error) {
  console.error('Failed to build changelogs:', error)
  process.exit(1)
}
