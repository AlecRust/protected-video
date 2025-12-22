import { mkdir, copyFile } from 'node:fs/promises';
import path from 'node:path';

const rootDir = process.cwd();
const sourceDir = path.join(rootDir, 'node_modules', 'plyr', 'dist');
const targetDir = path.join(rootDir, 'build', 'vendor', 'plyr');

await mkdir(targetDir, { recursive: true });

await Promise.all([
	copyFile(
		path.join(sourceDir, 'plyr.min.js'),
		path.join(targetDir, 'plyr.min.js')
	),
	copyFile(
		path.join(sourceDir, 'plyr.css'),
		path.join(targetDir, 'plyr.css')
	),
	copyFile(
		path.join(sourceDir, 'plyr.svg'),
		path.join(targetDir, 'plyr.svg')
	),
]);
