const { execSync } = require('child_process')
const packageJson = require('../package.json')

const nextVersion = packageJson.version
const cliffChangelogCmd = `git-cliff --config .cliff/cliff-changelog-md.toml -o CHANGELOG.md --tag v${nextVersion}`
const cliffReadmeCmd = `git-cliff --config .cliff/cliff-readme-txt.toml -o readme.txt --tag v${nextVersion}`

try {
  execSync(cliffChangelogCmd, { stdio: 'inherit' })
  execSync(cliffReadmeCmd, { stdio: 'inherit' })
} catch (error) {
  console.error('Failed to build changelogs:', error)
  process.exit(1)
}
