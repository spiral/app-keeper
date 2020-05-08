export interface IQRCodeOptions {
    value: string;
    type: 'canvas' | 'svg';
    size: number;
    ecLevel: 'L' | 'M' | 'Q' | 'H';
    fgColor: string;
    bgColor: string;
    logoUrl: string;
    logoHeight: number;
    logoWidth: number;
    logoMargin: number;
    logoX: number;
    logoY: number;
}
