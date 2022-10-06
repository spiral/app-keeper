import sf, { IOptionToGrab, ISpiralFramework } from '@spiral-toolkit/core';
import { ICodeEditorOptions } from './types';
export declare class CodeEditor extends sf.core.BaseDOMConstructor {
    static readonly spiralFrameworkName: string;
    static readonly spiralFrameworkCssName: string;
    static readonly defaultOptions: ICodeEditorOptions;
    options: ICodeEditorOptions;
    readonly name: string;
    textarea: HTMLTextAreaElement;
    readonly optionsToGrab: {
        [option: string]: IOptionToGrab;
    };
    private CodeEditor;
    constructor(ssf: ISpiralFramework, node: Element, options: ICodeEditorOptions);
    normalizeValue(value: string): string;
    denormalizeValue(value: string): string;
    setExternalValue(value: string): void;
    die(): void;
}
