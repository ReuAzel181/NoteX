"use client"

import * as React from 'react'
import { useRef, useState, useEffect } from 'react'
import { DashboardNav } from '@/components/dashboard-nav'
import { Button } from '@/components/ui/button'
import { Download, Eraser, Circle, Square, Pencil, Type, Undo, Redo, Sparkles } from 'lucide-react'

export default function DrawPage() {
  const canvasRef = useRef<HTMLCanvasElement>(null)
  const [tool, setTool] = useState<'pencil' | 'eraser' | 'circle' | 'square' | 'text'>('pencil')
  const [color, setColor] = useState('#000000')
  const [size, setSize] = useState(2)
  const [isDrawing, setIsDrawing] = useState(false)
  const [lastX, setLastX] = useState(0)
  const [lastY, setLastY] = useState(0)

  const colors = ['#000000', '#FF0000', '#00FF00', '#0000FF', '#FFFF00', '#FF00FF', '#00FFFF']
  const sizes = [2, 4, 6, 8, 10]

  useEffect(() => {
    const canvas = canvasRef.current
    if (!canvas) return

    const ctx = canvas.getContext('2d')
    if (!ctx) return

    // Set canvas size
    canvas.width = canvas.offsetWidth
    canvas.height = canvas.offsetHeight

    // Set initial styles
    ctx.strokeStyle = color
    ctx.lineWidth = size
    ctx.lineCap = 'round'
  }, [color, size])

  const startDrawing = (e: React.MouseEvent<HTMLCanvasElement>) => {
    const canvas = canvasRef.current
    if (!canvas) return

    const rect = canvas.getBoundingClientRect()
    const x = e.clientX - rect.left
    const y = e.clientY - rect.top

    setIsDrawing(true)
    setLastX(x)
    setLastY(y)
  }

  const draw = (e: React.MouseEvent<HTMLCanvasElement>) => {
    if (!isDrawing) return

    const canvas = canvasRef.current
    if (!canvas) return

    const ctx = canvas.getContext('2d')
    if (!ctx) return

    const rect = canvas.getBoundingClientRect()
    const x = e.clientX - rect.left
    const y = e.clientY - rect.top

    ctx.beginPath()
    ctx.strokeStyle = tool === 'eraser' ? '#FFFFFF' : color
    ctx.lineWidth = tool === 'eraser' ? size * 2 : size

    switch (tool) {
      case 'pencil':
      case 'eraser':
        ctx.moveTo(lastX, lastY)
        ctx.lineTo(x, y)
        ctx.stroke()
        break
      case 'circle':
        const radius = Math.sqrt(Math.pow(x - lastX, 2) + Math.pow(y - lastY, 2))
        ctx.arc(lastX, lastY, radius, 0, 2 * Math.PI)
        ctx.stroke()
        break
      case 'square':
        const width = x - lastX
        const height = y - lastY
        ctx.strokeRect(lastX, lastY, width, height)
        break
    }

    setLastX(x)
    setLastY(y)
  }

  const stopDrawing = () => {
    setIsDrawing(false)
  }

  const downloadCanvas = () => {
    const canvas = canvasRef.current
    if (!canvas) return

    const link = document.createElement('a')
    link.download = 'drawing.png'
    link.href = canvas.toDataURL()
    link.click()
  }

  return (
    <div className="min-h-screen bg-gradient-to-br from-slate-50 via-blue-50 to-indigo-100 dark:from-slate-900 dark:via-slate-800 dark:to-slate-900">
      <DashboardNav />
      <main className="container mx-auto p-4 md:p-8">
        <div className="flex items-center justify-between mb-8">
          <div className="flex items-center space-x-3">
            <div className="relative">
              <Sparkles className="h-8 w-8 text-emerald-500" />
              <div className="absolute inset-0 bg-emerald-500/20 rounded-full blur-sm"></div>
            </div>
            <div>
              <h1 className="text-4xl font-bold bg-gradient-to-r from-emerald-600 via-green-600 to-teal-600 bg-clip-text text-transparent">
                Digital Canvas
              </h1>
              <p className="text-muted-foreground">Create stunning digital artwork</p>
            </div>
          </div>
          <div className="flex items-center gap-4">
            <div className="flex gap-2 bg-white/50 dark:bg-slate-800/50 backdrop-blur-sm p-2 rounded-xl border border-white/20">
              {colors.map((c) => (
                <button
                  key={c}
                  className={`w-8 h-8 rounded-full border-2 border-white/20 transition-all duration-300 hover:scale-110 ${color === c ? 'ring-2 ring-emerald-500 ring-offset-2 scale-110' : 'hover:ring-2 hover:ring-emerald-500/50'}`}
                  style={{ backgroundColor: c }}
                  onClick={() => setColor(c)}
                />
              ))}
            </div>
            <select
              className="px-4 py-2 border border-white/20 bg-white/50 dark:bg-slate-800/50 backdrop-blur-sm rounded-xl focus:outline-none focus:ring-2 focus:ring-emerald-500/50 focus:border-transparent transition-all duration-300"
              value={size}
              onChange={(e) => setSize(Number(e.target.value))}
            >
              {sizes.map((s) => (
                <option key={s} value={s}>
                  {s}px
                </option>
              ))}
            </select>
            <div className="flex gap-2 bg-white/50 dark:bg-slate-800/50 backdrop-blur-sm p-2 rounded-xl border border-white/20">
              {[
                { name: 'pencil', icon: Pencil },
                { name: 'eraser', icon: Eraser },
                { name: 'circle', icon: Circle },
                { name: 'square', icon: Square },
                { name: 'text', icon: Type }
              ].map((t) => (
                <Button
                  key={t.name}
                  variant={tool === t.name ? "default" : "outline"}
                  size="icon"
                  onClick={() => setTool(t.name as typeof tool)}
                  className={`${tool === t.name ? 'bg-gradient-to-r from-emerald-500 to-green-600' : 'border-white/20 bg-white/50 dark:bg-slate-700/50 backdrop-blur-sm hover:bg-white/70 dark:hover:bg-slate-600/70'} transition-all duration-300 hover:scale-105`}
                >
                  <t.icon className="h-4 w-4" />
                </Button>
              ))}
            </div>
            <div className="flex gap-2 bg-white/50 dark:bg-slate-800/50 backdrop-blur-sm p-2 rounded-xl border border-white/20">
              <Button variant="outline" size="icon" className="border-white/20 bg-white/50 dark:bg-slate-700/50 backdrop-blur-sm hover:bg-white/70 dark:hover:bg-slate-600/70 transition-all duration-300 hover:scale-105">
                <Undo className="h-4 w-4" />
              </Button>
              <Button variant="outline" size="icon" className="border-white/20 bg-white/50 dark:bg-slate-700/50 backdrop-blur-sm hover:bg-white/70 dark:hover:bg-slate-600/70 transition-all duration-300 hover:scale-105">
                <Redo className="h-4 w-4" />
              </Button>
              <Button variant="outline" size="icon" onClick={downloadCanvas} className="border-white/20 bg-white/50 dark:bg-slate-700/50 backdrop-blur-sm hover:bg-white/70 dark:hover:bg-slate-600/70 transition-all duration-300 hover:scale-105">
                <Download className="h-4 w-4" />
              </Button>
            </div>
          </div>
        </div>
        
        <div className="bg-white/80 dark:bg-slate-800/80 backdrop-blur-sm border border-white/20 rounded-2xl p-6 shadow-xl hover:shadow-2xl transition-all duration-300">
          <canvas
            ref={canvasRef}
            className="w-full h-[70vh] border border-white/20 rounded-xl cursor-crosshair bg-white shadow-inner"
            onMouseDown={startDrawing}
            onMouseMove={draw}
            onMouseUp={stopDrawing}
            onMouseLeave={stopDrawing}
          />
        </div>
      </main>
    </div>
  )
} 